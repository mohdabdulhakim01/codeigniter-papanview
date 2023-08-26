<?php
// Author : Mohammad Abdul Hakim

function linkbar($current_url)
{
    $links = explode('/', $current_url);
    // return json_encode($links);
    $home = $links[3];
    unset($links[0]);
    unset($links[1]);
    unset($links[2]);
    unset($links[3]);
    unset($links[4]);
    // return json_encode($links);

    $linkData = linkBuilder($links);
    return <<<EOF
           
            <div aria-label="breadcrumb" class="navbar bg-dark">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"  class="text-white"><span class="fas fa-home"></span></a></li>
                $linkData
              
            </ol>
            </div>

            
           
EOF;
}
function linkBuilder($linkArr)
{
    $html = '';
    $index = 0;
    foreach ($linkArr as $key => $link) {
        if (is_numeric($link)) {
            continue;
        }
        if ($index == count($linkArr) - 1) {
            $html .= '  <li class="breadcrumb-item active "><a href="' . addBackUrl($index, count($linkArr) - 1, $link) . '" class="text-white">' . ucwords(prettynavurl($link)) . '</a></li>';
        } else {
            $html .= '  <li class="breadcrumb-item"><a href="' . addBackUrl($index, count($linkArr) - 1, $link) . '" class="text-white">' . ucwords(prettynavurl($link)) . '</a></li>';
        }
        $index++;
    }
    return $html;
}
function prettynavurl($url)
{
    $rewrite_nav_url = '';
    foreach (str_split($url) as $key => $char) {
        if (ctype_upper($char)) {
            if ($key != 0) {
                $rewrite_nav_url .= ' ' . $char;
            } else {
                $rewrite_nav_url .= $char;
            }
        } else {
            if ($char == '_') {
                $rewrite_nav_url .= ' ';
            } else {
                $rewrite_nav_url .= $char;
            }
        }
    }
    return $rewrite_nav_url;
}
function addBackUrl($currentIndex, $count_total, $link)
{
    $dot = '';
    $dotCount = $count_total - 1 - $currentIndex;
    for ($x = 0; $x <= $dotCount; $x++) {
        $dot .= '.';
    }
    return $dot;
}
function currentPage()
{
    $CI = &get_instance();
    $page =  $CI->input->get('page');
    if (empty($page)) {
        $page = 1;
    }
    return $page;
}
function out($value)
{
    // spit out the value. cleaner than 
    // patching quote bug on html
    $value = str_replace('\\\'', '\'', $value);
    echo $value;
}
function datePretty($value)
{
    return date('Y/m/d', strtotime($value));
}
function dateInpVal($value)
{
    return date('Y-m-d', strtotime($value));
}
function dateDMY($date)
{
    return date('d/m/Y', strtotime($date));
}
function papanView($template, $data)
{

    // Parse all data to mimic blade template
    // Author : Mohd Abdul Hakim
    // Papan Templating Engine : simple php parser with templating layout.
    // .extension : .papan.php
    if (!file_exists(APPPATH . '/views/' . $template . '.papan.php')) {
        echo '<div class="d-flex flex-column">';
        echo '<span class="fas fa-3xl">PapanView : Error Detected : </span>';
        echo '<span><span style="color:orange">Warning</span>: File ' . APPPATH . '/views/' . $template . '.papan.php tidak wujud</span>';
        echo '</div>';
        return;
    }
    $content = file_get_contents(APPPATH . '/views/' . $template . '.papan.php');
    $content_s = '<?php $_this = &get_instance(); ?>';
    $content_s .= '<?php ';
    $content = parsePapan($content);
    foreach ($data as $key => $per_data) {
        if (is_array($per_data)) {
            $content_s .= '$' . $key . ' = json_decode(\'' . addslashes(json_encode($per_data)) . '\');';
        } else if (is_object($per_data)) {
            $content_s .= '$' . $key . ' = json_decode(\'' . addslashes(json_encode((array) $per_data)) . '\');';
        } else {
            $content_s .= '$' . $key . ' = \'' . $per_data . '\';';
        }
    }
    $content_s = str_replace('\"', '"', $content_s);
    $content_s .= '?> ';
    eval('?>' . $content_s . $content . '<?php ');

    return;
}
function parsePapan($content)
{
    $content = componentParser($content);

    $content = str_replace("{{", '<?php out( $_this->security->xss_clean(', $content);
    $content = str_replace("}}", ")); ?>", $content);
    //
    $content = str_replace("{!!", "<?php ", $content);
    $content = str_replace("!!}", " ?>", $content);
    // newly added @php @endphp 19/07/2023

    $content = str_replace("@php", "<?php ", $content);
    $content = str_replace("@endphp", " ?>", $content);

    $content = str_replace(")::", "): ?>", $content); // @syntax parser

    $content = str_replace("@foreach", "<?php foreach", $content);
    $content = str_replace("@endforeach", "<?php endforeach; ?>", $content);
    // newly added @for 19/07/2023

    $content = str_replace("@for", "<?php for", $content);
    $content = str_replace("@endfor", "<?php endfor; ?>", $content);

    $content = str_replace("@if", "<?php if", $content);
    $content = str_replace("@endif", "<?php endif; ?>", $content);
    // newly added else elseif 19/07/2023
    $content = str_replace("@elseif", "<?php elseif", $content);
    $content = str_replace("@else", "<?php else: ?>", $content);

    $content = str_replace("@while", "<?php while", $content);
    $content = str_replace("@endwhile", "<?php endwhile; ?>", $content);

    // special @object($object_name)::; to automatically convert variable to object
    $content  = toObjectParser($content);

    // dumb component parse
    /*
        trying to mimic <x-com></x-com> tag from blade view
        <x-header/>    --> <?php xcom(')

    */
    return $content;
}
function toObjectParser($content)
{
    preg_match_all('/@object(\s*(.*?)\s*):;/s', $content, $components);

    if (count($components) > 0) {
        foreach ($components as $per_com) {
            if (empty($per_com[0])) {
                continue;
            } else {
                $object_name = explode('(', $per_com[0])[1];
                $object_name = explode(')', $object_name)[0];
                $content = str_replace("@object(", "<?php " . $object_name . " = (object) ", $content);
                $content = str_replace("):;", "; ?>", $content);
            }
        }
    }
    return $content;
}

function componentParser($content)
{
    preg_match_all('/<x-\s*(.*?)\s*\/>/s', $content, $components);
    // standalone component
    $content = componentParseProcess($content, $components, '<x-', '/>', false);

    return $content;
}
function componentParseProcess($content, $components, $starttag, $endtag, $with_slot)
{
    $starttag = str_replace('<', '&lt', $starttag);
    $endtag = str_replace('<', '&gt', $endtag);
    if (count($components) > 0) {
        $component_list = $components[1];

        foreach ($component_list as $key => $component) {
            if (!empty($component)) {
                // detect inner attribute like title or whatever var. and pass to as variable

                $array_attr = preg_split('~(?<!\\\\)(?:\\\\{2})*"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"(*SKIP)(*F)|\s+~s', $component); // https://stackoverflow.com/questions/51553120/php-string-explode-on-space-except-when-in-quotes
                $com_content = '';
                $component_name = '';
                if (count($array_attr) > 1) {
                    // contain attribute
                    $component_name = $array_attr[0];
                    $prop = $array_attr[1];
                    $per_variable  = explode('=', $prop);
                    $var_name = $per_variable[0];
                    $val_data = $per_variable[1];
                    $val_data = str_replace('"', '', $val_data);
                    $val_data = str_replace('\'', '', $val_data);

                    if (str_contains_('::', $var_name)) {
                        // use array
                        $com_content = '<?php xcomarr(\'' . $component_name . '\',json_encode(' . $val_data . ')); ?>';
                    } elseif (str_contains_(':', $var_name)) {
                        $com_content = '<?php xcomc(\'' . $component_name . '\',' . $val_data . '); ?>';
                    } else {
                        // regular
                        $com_content = '<?php xcomc(\'' . $component_name . '\',\'' . $val_data . '\'); ?>';
                    }
                    // replace those content,
                    $content = str_replace('<x-' . $component . '/>', $com_content, $content);
                    $content = str_replace('<x-' . $component . ' />', $com_content, $content);
                } else {
                    // non attribute
                    $component_name = $array_attr[0];
                    $com_content = '<?php xcom(\'' . $component_name . '\'); ?>';
                    $content = str_replace('<x-' . $component_name . '/>', $com_content, $content);
                    $content = str_replace('<x-' . $component_name . ' />', $com_content, $content);
                }
            }
        }
    }

    return $content;
}


// external shortcut function for views or PapanView
function getJantina($type)
{
    $fullJantina = '';
    $jantina = strtolower($type);
    switch ($jantina) {
        case 'l':
            $fullJantina =  'LELAKI <span class="fas fa-mars text-primary fa-xl"></span>';
            break;
        case 'p':
            $fullJantina = 'PEREMPUAN <span class="fas fa-venus text-primary fa-xl"></span>';
            break;
    }
    return $fullJantina;
}

function emailto($provider, $email)
{
    $provider_list = [
        ['name' => 'jpa', 'link' => 'ddd'],
        ['name' => 'gmail', 'link' => 'https://mail.google.com/mail/u/0/?fs=1&to=[emel]&su=[header]&body=[content]]&&tf=cm']
    ];
    foreach ($provider_list as $per_provider) {
        $per_provider = (object) $per_provider;
        if ($per_provider->name == $provider) {
            $link = $per_provider->link;
            $link = str_replace('[emel]', $email, $link);
            return $link;
        }
    }
}
function getCurrentDate()
{
    $date =  strtolower(date('d, F Y'));
    $months = [
        1 => ['malay' => 'Januari', 'english' => 'January'],
        2 => ['malay' => 'Februari', 'english' => 'February'],
        3 => ['malay' => 'Mac', 'english' => 'March'],
        4 => ['malay' => 'April', 'english' => 'April'],
        5 => ['malay' => 'Mei', 'english' => 'May'],
        6 => ['malay' => 'Jun', 'english' => 'June'],
        7 => ['malay' => 'Julai', 'english' => 'July'],
        8 => ['malay' => 'Ogos', 'english' => 'August'],
        9 => ['malay' => 'September', 'english' => 'September'],
        10 => ['malay' => 'Oktober', 'english' => 'October'],
        11 => ['malay' => 'November', 'english' => 'November'],
        12 => ['malay' => 'Disember', 'english' => 'December']
    ];
    $date = strtolower($date);
    foreach ($months as $per_month) {
        $per_month = (object) $per_month;
        $date = str_replace(strtolower($per_month->english), $per_month->malay, $date);
    }
    return ucwords($date);
}

function unfilterXSSCI($raw_html)
{
    $list = [['from' => 'papanclick', 'to' => 'onclick']];
    foreach ($list as $per_row) {
        $per_row = (object) $per_row;
        $raw_html = str_replace($per_row->from, $per_row->to, $raw_html);
    }
    return $raw_html;
}
function removeAnomaliesStr($string)
{
    $anomalies = ['\"', '\''];
    foreach ($anomalies as $per_anomaly) {
        $string = str_replace($per_anomaly, '', $string);
    }
    return $string;
}
function cloneHtml($content, $count)
{
    $htmlContent = '';
    for ($x = 1; $x <= $count; $x++) {
        $htmlContent .= $content;
    }
    return $htmlContent;
}

function str_contains_($needle, $haystack) // PHP 8 function. clone
{
    return strpos($haystack, $needle) !== false;
}


function papanPaginate($ctrlPath,$dataTotalRows,$rowsPerPage)
{
    $CI = &get_instance();
    $current_page = (!empty($CI->input->get('page'))) ? $CI->input->get('page') : 1;
    $current_page = ($current_page != 0) ? ($current_page - 1) : 1;
    $config['cur_page'] = $current_page;
    $config['per_page'] = $rowsPerPage;
    $controller_path = base_url() . $ctrlPath;
    $total_rows = $dataTotalRows;
    $paginator_config = (array) page_config($controller_path, $total_rows, $rowsPerPage, $current_page);

    $CI->pagination->initialize($paginator_config);
    $total_pg = $total_rows / $rowsPerPage;
    $is_more_pg =  (strpos($total_pg, '.') !== false);
    $CI->pagination->total_page = ($is_more_pg) ? round($total_pg) + 1 : $total_pg;
  
    return ['links'=>$CI->pagination->create_links(),'total'=>$total_rows,'linkbar'=>linkbar(current_url()),'totalPage'=> $total_rows,'current_page'=>$current_page];
}

function decodeFName($filename){
    $filename = str_replace(':slashf:','/',$filename);
    $filename = str_replace(':slashb:','\\',$filename);
    return $filename;
}

function includeCalcPattern($calcPatternFilePath){
    $calcPatternPath = APPPATH.'/helpers/calc_pattern/'.$calcPatternFilePath.'.php';
    include_once($calcPatternPath);
}
function isSAdmin(){
    $CI = &get_instance();
    $CI->load->library('session');
    return $CI->session->userdata('sa_mode') ? : '';
}