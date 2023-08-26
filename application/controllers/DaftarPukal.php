<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarPukal extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('RespondenModel');
		$this->load->model('M_Program');
		$this->load->model('Sesi');
		$this->load->model('Kod_Ujian');
		$this->load->model('Program_Ujian');
		$this->load->library('excel');
		$this->isAdmin();

		// lib and helper
		$this->load->helper('html_base');
		$this->load->helper('xcomponent');
		$this->load->helper('ujianview');
		$this->load->helper('sesi_base');
	}

	public function _index()
	{
		$data = array();
		//$data['status'] = $this->Sesi->check_status_menjawab($this->session->userdata('id_calon'),$this->session->userdata('program'));
		$data['content'] = 'pentadbir/v_form_daftarpukal';
		$this->load->view('pentadbir/template_admin', $data);
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

	public function daftar_process()
	// Author Mohd Abdul Hakim
	{
		$kod_program = $this->input->get('kod_program');
		$mode = $this->input->get('mode');
		$data_responden_pukal = json_decode($this->input->raw_input_stream);
		$ujian_program = $this->Program_Ujian->getAllAvailableUjian($kod_program);
		$output = $this->daftarPukalEngine($data_responden_pukal, $kod_program, $ujian_program, $mode);
		echo json_encode($output);
	}
	function cleanUpUniqueKP($data)
	{
		$data = str_replace('\'', '', $data);
		$data = str_replace('"', '', $data);
		$data = str_replace('‎', '', $data);
		$data = str_replace(' ', '', $data);
		return $data;
	}
	function rewriteDataResponden($data)
	{
		$new_temp = [];
		$data = (array) $data;
		$x = 0;
		foreach ($data as $key => $per_temp) {
			if ($x == 0) {
				$new_temp = array_merge($new_temp, [$key => '‎' . $per_temp]);
			} else {
				$new_temp = array_merge($new_temp, [$key => $per_temp]);
			}
			$x++;
		}
		return (array) $new_temp;
	}

	function daftarPukalEngine($data, $kod_program, $ujian_program, $mode)
	{
		$error_data = [];
		$cleaned_data = [];
		$is_success = true;
		$error_list = [];
		$error_msg_list = [];
		$msg = '';
		foreach ($data as $key => $per_responden) {
			$skip = true;
			$is_valid = true;

			if ($mode == 'gui') {
				if ($key == 0)
					continue;
			} else {
				$temp_per_responden  = $per_responden;
				$per_responden = array_values((array) $per_responden);
			}

			$total_col = count($per_responden);
			for ($counter  = 0; $counter < $total_col; $counter++) {
				if ($per_responden[$counter] != null) {
					$skip = false;
					break;
				}
			}

			$nokp = $this->cleanUpUniqueKP($per_responden[0]);
			$nama_responden = $per_responden[1];
			$jantina = strtoupper($per_responden[2]);
			$emel =  strtolower(trim($per_responden[3]));
			$hashKP = sha1($per_responden[0]);
			$kementerian = $per_responden[4];
			$agensi = $per_responden[5];
			$bahagian = $per_responden[6];
			if ($nokp == null)
				continue;

			// if (strlen($nokp) != 12 || (!is_numeric($nokp))) {
			// 	$is_valid = false;
			// 	if (!in_array(1, $error_list)) {
			// 		array_push($error_list, 1);
			// 		array_push($error_msg_list, 'Format no kad pengenalan tidak tepat');
			// 	};
			// }
			if (empty($nama_responden)) {
				$is_valid = false;
				if (!in_array(2, $error_list)) {
					array_push($error_list, 2);
					array_push($error_msg_list, 'Terdapat nama responden yang tidak diisi');
				};
			}
			if (empty($jantina)) {
				$is_valid = false;
				if (!in_array(3, $error_list)) {
					array_push($error_list, 3);
					array_push($error_msg_list, 'Terdapat jantina yang tidak diisi');
				};
			}
			if (empty($emel)) {
				$is_valid = false;
				if (!in_array(4, $error_list)) {
					array_push($error_list, 4);
					array_push($error_msg_list, 'Terdapat emel yang tidak diisi');
				};
			}
			if (!filter_var($emel, FILTER_VALIDATE_EMAIL)) {
				$is_valid = false;
				if (!in_array(5, $error_list)) {
					array_push($error_list, 5);
					array_push($error_msg_list, 'Terdapat format emel yang tidak betul');
				};
			}
			if (!$is_valid) {
				if ($mode == 'upload') {
					$temp_per_responden = $this->rewriteDataResponden((array) $temp_per_responden);
					array_push($error_data,  $temp_per_responden);
				} else {
					$per_responden =  $this->rewriteDataResponden((array) $per_responden);
					array_push($error_data, $per_responden);
				}
				$is_success = false;
				continue;
			}
			if ($skip == false) {
				$dataresponden = [
					'NoKP'  => $nokp,
					'NamaResponden'   => $nama_responden,
					'Jantina'    => $jantina,
					'Emel'  => $emel,
					'HashNoKP'   => $hashKP
				];
				array_push($cleaned_data, $dataresponden);
				if (!$this->RespondenModel->ifRespondenExist($nokp)) {
					$this->RespondenModel->simpanResponden($dataresponden);
				}

				foreach ($ujian_program as $up) {
					$up = (object) $up;
					$datasesi = array(
						'NoKP'  => $nokp,
						'Kementerian' => $kementerian,
						'Agensi' => $agensi,
						'Bahagian' => $bahagian,
						'idUjian' => $up->kodUjian,
						'kodProgram' => $kod_program,
						'createdBy' => $this->session->userdata('id_admin')
					);
					if (empty($this->Sesi->isExistSessionAnswered($kod_program, $up->kodUjian,  $nokp))) {
						// if sesi not wujud than add
						if(!$this->Sesi->respondenWujudBagiProgramUjian($kod_program,$nokp,$up->kodUjian)){
							$this->Sesi->insertByUrusetia($datasesi);
						}
					}
					// echo json_encode($datasesi);
				}
			}
		}
		return ['code' => ($is_success ? 1 : 0), 'data_mistake' => $error_data, 'msg' => $error_msg_list];
	}
	// public function muatnaik()
	//     {
	// 		ini_set('upload_max_filesize','1000M');
	// 		ini_set('post_max_size','2000M');
	// 		$data = array();
	//       if(isset($_POST["import"]))
	//         {
	// 			$kodProgram = $this->input->post('field-autocomplete');
	// 			//echo $kodProgram;
	// 			$ujian_program = $this->Program_Ujian->getSenaraiUjianByProgram($kodProgram);

	// 			$path = $_FILES["file"]["tmp_name"];
	// 			$object = PHPExcel_IOFactory::load($path);
	// 			foreach($object->getWorksheetIterator() as $worksheet)
	// 			{
	// 			$highestRow = $worksheet->getHighestRow();
	// 			$highestColumn = $worksheet->getHighestColumn();
	// 			for($row=2; $row<=$highestRow; $row++)
	// 				{
	// 				$nokp = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
	// 				$nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
	// 				$jantina = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
	// 				$emel = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
	// 				$kementerian = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
	// 				$agensi = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
	// 				$bahagian = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

	// 				$hashic = sha1($nokp);
	// 				if($this->RespondenModel->check_responden($hashic) == FALSE){
	// 				$dataresponden = array(
	// 					'NoKP'  => $nokp,
	// 					'NamaResponden'   => $nama,
	// 					'Jantina'    => $jantina,
	// 					'Emel'  => trim($emel),
	// 					'HashNoKP'   => $hashic
	// 				);
	// 				$this->RespondenModel->simpanResponden($dataresponden);
	// 				}
	// 				else {
	// 				$dataresponden = array(
	// 					'NamaResponden'   => $nama,
	// 					'Jantina'    => $jantina,
	// 					'Emel'  => trim($emel),
	// 					'HashNoKP'   => $hashic
	// 					);
	// 				$this->RespondenModel->kemaskiniRespondenPukal($nokp, $dataresponden);	
	// 				}

	// 				foreach($ujian_program as $up){
	// 					$datasesi = array(
	// 						'NoKP'  => $nokp,
	// 						'Kementerian' => $kementerian,
	// 						'Agensi' => $agensi,
	// 						'Bahagian' => $bahagian,
	// 						'idUjian'=>$up['idUjian'],			
	// 						'kodProgram'=>$kodProgram,
	// 						'createdBy'=> $this->session->userdata('id_admin')
	// 					);

	// 					if(empty($this->Sesi->semakByNoKPandIDUjianSecaraPukal($up['idUjian'], $kodProgram, $nokp))){
	// 						$this->Sesi->insertByUrusetia($datasesi);
	// 						}

	// 					}

	// 				}
	// 			}
	// 			$this->session->set_flashdata('status', 'Muatnaik Berjaya');
	// 			redirect('pentadbir/DaftarPukal');
	//         }
	//     } 


	public function berjaya()
	{
		if ($this->session->flashdata('status') != NULL) {
			echo 'berjaya';
		}
		//$data['content'] = 'pentadbir/v_form_daftarpukal';
		//$this->load->view('pentadbir/template_admin', $data);
	}


	public function isAdmin()
	{
		$current_url = current_url();
		$_SESSION['url_to_redirect'] = $current_url; 
		if (($this->session->userdata('admin') == FALSE) && ($this->session->userdata('id_admin') == FALSE)) {
			redirect('pentadbir/Verify');
		}
	}
}
