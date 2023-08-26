<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PanelModel');
		$this->load->helper('url');
		// lib and helper
		$this->load->helper('html_base');
		$this->load->helper('xcomponent');
	}

	public function index()
	{
		$senaraiPanel = $this->PanelModel->getPanelList();
		$data['senaraiPanel'] = $senaraiPanel;
		$papan_data = $data;
		papanView('panel/urus-panel',$papan_data);
	}
}
