<?php
function xcom($view_name)
{
    $view_path = APPPATH . '/views/components/' . $view_name . '.php';
    if (file_exists($view_path)) {
        require($view_path);
    } else {
        echo '<h4>X-Component : View Path does not exist ' . $view_path . '</h4>';
    }
}
function xcomc($view_name, $prop)
{
    // try to read using eval
    $randIndex = 'index' . rand(10000, 99999);
    $content = file_get_contents(APPPATH . '/views/components/' . $view_name . '.php');
    $content = str_replace("?>", "", $content);
    $content = str_replace("<?php", "", $content);
    $content = str_replace('index($prop)', $randIndex . '($prop)', $content);
    $php = $randIndex . '("' . $prop . '");';
    $content .= $php;
    eval($content);
}
function xcomarr($view_name, $prop)
{
    // try to read using eval
    $randIndex = 'index' . rand(10000, 99999);
    $content = file_get_contents(APPPATH . '/views/components/' . $view_name . '.php');
    $content = str_replace("?>", "", $content);
    $content = str_replace("<?php", "", $content);
    $content = str_replace('index($prop)', $randIndex . '($prop)', $content);
    $php = $randIndex . '((object) json_decode(\'' .  $prop . '\'));';
    $content .= $php;
    eval($content);
}
function xcomx($view_name,$source_data){
    $com_path = 'components/'.$view_name;
    $data = [];
    foreach($source_data as $key=>$per_data){
        $data[$key] = $per_data;
    }
    // echo json_encode($data);
    $papan_data = $data;
    papanView($com_path,$papan_data);
}
function arrBind($data){
    // add for something like compact sql command return result like {eheh:eee}. since json need bracket so add bracket then XD
    // and auto json decode the data
    $data = json_decode('['.$data.']');
    return $data;
}