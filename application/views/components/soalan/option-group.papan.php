<?php
$CI = &get_instance();

$data_option_group =  $CI->db->where('idOptionGroup', $idOptionGroup)->get('option_group_manager')->row();

?>
