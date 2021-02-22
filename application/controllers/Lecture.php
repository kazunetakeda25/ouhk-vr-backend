<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecture extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('lecture_model');
		$this->load->model('unit_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_lecture'] = $this->lecture_model->getAll();
            $this->load->view('Lecture/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function unitLecture($unit_number)
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_lecture'] = $this->lecture_model->getAllForUnit($unit_number);
            $this->load->view('Lecture/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function add() {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Lecture Title', 'required');
			
			if ($this->form_validation->run() == false || $_FILES === null) {
				$result['data_unit'] = $this->unit_model->getUnitList();
				$this->load->view('Lecture/add', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$title = $this->input->post('title');
				if ($_FILES['mp3']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["mp3"]["tmp_name"];
					$name = basename($_FILES["mp3"]["name"]);
					$mp3_path = 'uploads/lecture/' . $name;
					move_uploaded_file($tmp_name, $mp3_path);
					$array = array(
						'unit_number' => $unit_number, 
						'title' => $title, 
						'mp3' => $mp3_path
					);
					
					$result = $this->lecture_model->add($array);
					if ($result > 0) {
						redirect('/lecture');
					}
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id) {
		$result = $this->lecture_model->delete($id);
        if ($result > 0) {
			redirect('/lecture');
		}
	}

	public function edit($id) {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Lecture Title', 'required');
			
			if ($this->form_validation->run() == false) {
				$result['data_unit'] = $this->unit_model->getUnitList();
				$result['data_lecture'] = $this->lecture_model->get($id);
				$this->load->view('Lecture/edit', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$title = $this->input->post('title');
				$change_mp3 = $this->input->post('change_mp3');
				if ($change_mp3 == 1) {
					if ($_FILES['mp3']['error'] == UPLOAD_ERR_OK) {
						$tmp_name = $_FILES["mp3"]["tmp_name"];
						$name = basename($_FILES["mp3"]["name"]);
						$mp3_path = 'uploads/lecture/' . $name;
						move_uploaded_file($tmp_name, $mp3_path);
						$array = array(
							'unit_number' => $unit_number, 
							'title' => $title, 
							'mp3' => $mp3_path
						);
						
						$result = $this->lecture_model->update($id, $array);
						if ($result > 0) {
							redirect('/lecture');
						}
					}
				} else {
					$array = array(
						'unit_number' => $unit_number, 
						'title' => $title
					);
					
					$result = $this->lecture_model->update($id, $array);
					if ($result > 0) {
						redirect('/lecture');
					}
				}
			}
		} else {
			redirect('/login');
		}
	}
}