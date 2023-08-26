<?php

function page_config($controller_path,$total_rows,$record_per_page,$uri_segment)
{
    // $config["base_url"] = base_url() . "pentadbir/Program";
    // $config["total_rows"] = $this->M_Program->get_total_program();
    // $config["per_page"] = 10;
    // $config["uri_segment"] = 3;
    $config["base_url"] = $controller_path;
    $config["total_rows"] = $total_rows;
    $config["per_page"] = $record_per_page;
    $config["uri_segment"] = $uri_segment;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = "&laquo;";
    $config['last_link'] ="&raquo;";
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = 'Sebelum';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = 'Seterusnya';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $page_config = (object) $config;
    return $page_config;
}
function autoIndexPage($index){
    $CI = &get_instance();
    $page =  $CI->input->get('page');
    if (empty($page)) {
        $page = 1;
    }
    
    $index +=(($page-1)*10);
    return $index;
}