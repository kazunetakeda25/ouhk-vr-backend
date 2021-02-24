<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Practice extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('practice_model');
		$this->load->model('unit_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_practice'] = $this->practice_model->getAll();
			$this->load->view('Practice/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function unitPractice($unit_number)
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_practice'] = $this->practice_model->getAllForUnit($unit_number);
			$this->load->view('Practice/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function add()
	{
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('number', 'Practice Number', 'required');
			$this->form_validation->set_rules('title', 'Practice Title', 'required');

			if ($this->form_validation->run() == false || $_FILES === null) {
				$result['data_unit'] = $this->unit_model->getUnitListForContent('tbl_practice');
				$this->load->view('Practice/add', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$number = $this->input->post('number');
				$title = $this->input->post('title');

				$array = array(
					'unit_number' => $unit_number,
					'number' => $number,
					'title' => $title
				);

				if ($_FILES['ex1_mp3'] != null && $_FILES['ex1_mp3']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["ex1_mp3"]["tmp_name"];
					$name = basename($_FILES["ex1_mp3"]["name"]);
					$ex1_mp3_path = 'uploads/audio/' . $name;
					move_uploaded_file($tmp_name, $ex1_mp3_path);
					$array['ex1_mp3'] = $ex1_mp3_path;
				}

				if ($_FILES['ex1_mp4'] != null && $_FILES['ex1_mp4']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["ex1_mp4"]["tmp_name"];
					$name = basename($_FILES["ex1_mp4"]["name"]);
					$ex1_mp4_path = 'uploads/video/' . $name;
					move_uploaded_file($tmp_name, $ex1_mp4_path);
					$array['ex1_mp4'] = $ex1_mp4_path;
				}

				if ($_FILES['ex2_mp3'] != null && $_FILES['ex2_mp3']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["ex2_mp3"]["tmp_name"];
					$name = basename($_FILES["ex2_mp3"]["name"]);
					$ex2_mp3_path = 'uploads/audio/' . $name;
					move_uploaded_file($tmp_name, $ex2_mp3_path);
					$array['ex2_mp3'] = $ex2_mp3_path;
				}

				if ($_FILES['ex2_mp4'] != null && $_FILES['ex2_mp4']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["ex2_mp4"]["tmp_name"];
					$name = basename($_FILES["ex2_mp4"]["name"]);
					$ex2_mp4_path = 'uploads/video/' . $name;
					move_uploaded_file($tmp_name, $ex2_mp4_path);
					$array['ex2_mp4'] = $ex2_mp4_path;
				}


				$result = $this->practice_model->add($array);
				if ($result > 0) {
					redirect('/practice');
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id)
	{
		$result = $this->practice_model->delete($id);
		if ($result > 0) {
			redirect('/practice');
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('number', 'Practice Number', 'required');
			$this->form_validation->set_rules('title', 'Practice Title', 'required');

			if ($this->form_validation->run() == false) {
				$result['data_unit'] = $this->unit_model->getUnitListForContent('tbl_practice', $id);
				$result['data_practice'] = $this->practice_model->get($id);
				$this->load->view('Practice/edit', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$number = $this->input->post('number');
				$title = $this->input->post('title');
				$change_ex1_mp3 = $this->input->post('change_ex1_mp3');
				$change_ex1_mp4 = $this->input->post('change_ex1_mp4');
				$change_ex2_mp3 = $this->input->post('change_ex2_mp3');
				$change_ex2_mp4 = $this->input->post('change_ex2_mp4');

				$array = array(
					'unit_number' => $unit_number,
					'number' => $number,
					'title' => $title,
				);

				if ($change_ex1_mp3 == 1 && $_FILES['ex1_mp3']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["ex1_mp3"]["tmp_name"];
					$name = basename($_FILES["ex1_mp3"]["name"]);
					$ex1_mp3_path = 'uploads/audio/' . $name;
					move_uploaded_file($tmp_name, $ex1_mp3_path);
					$array['ex1_mp3'] = $ex1_mp3_path;
				}

				if ($change_ex1_mp4 == 1 && $_FILES['ex1_mp4']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["ex1_mp4"]["tmp_name"];
					$name = basename($_FILES["ex1_mp4"]["name"]);
					$ex1_mp4_path = 'uploads/video/' . $name;
					move_uploaded_file($tmp_name, $ex1_mp4_path);
					$array['ex1_mp4'] = $ex1_mp4_path;
				}

				if ($change_ex2_mp3 == 1 && $_FILES['ex2_mp3']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["ex2_mp3"]["tmp_name"];
					$name = basename($_FILES["ex2_mp3"]["name"]);
					$ex2_mp3_path = 'uploads/audio/' . $name;
					move_uploaded_file($tmp_name, $ex2_mp3_path);
					$array['ex2_mp3'] = $ex2_mp3_path;
				}

				if ($change_ex2_mp4 == 1 && $_FILES['ex2_mp4']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["ex2_mp4"]["tmp_name"];
					$name = basename($_FILES["ex2_mp4"]["name"]);
					$ex2_mp4_path = 'uploads/video/' . $name;
					move_uploaded_file($tmp_name, $ex2_mp4_path);
					$array['ex2_mp4'] = $ex2_mp4_path;
				}

				$result = $this->practice_model->update($id, $array);
				if ($result > 0) {
					redirect('/practice');
				}
			}
		} else {
			redirect('/login');
		}
	}
}
