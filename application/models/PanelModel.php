<?php

class PanelModel extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getPanelList()
    {
        return $this->db->get('panel')->result_array();
    }
}
