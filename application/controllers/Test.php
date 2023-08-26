<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		
		// lib and helper
		$this->load->helper('html_base');
		$this->load->helper('xcomponent');
		$this->load->helper('ujianview');
		$this->load->helper('sesi_base');
	}



	public function index()
	{
		$kod_program = $this->input->get('kod_program');
		$data_kod_program = $this->db->where('kodProgram', $kod_program)->get('program')->row();
		$content = 'pentadbir_baru/responden/daftar_pukal';
		$data['data_kod_program'] = $data_kod_program;
		$papan_data = $data;
		papanView($content, $papan_data);
	}

}
