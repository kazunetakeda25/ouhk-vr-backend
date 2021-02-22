<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Practice extends CI_Controller {

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

	public function add() {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Practice Title', 'required');
			
			if ($this->form_validation->run() == false || $_FILES === null) {
				$result['data_unit'] = $this->unit_model->getUnitList();
				$this->load->view('Practice/add', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$title = $this->input->post('title');
				if ($_FILES['video']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["video"]["tmp_name"];
					$name = basename($_FILES["video"]["name"]);
					$video_path = 'uploads/practice/' . $name;
					move_uploaded_file($tmp_name, $video_path);
					$array = array(
						'unit_number' => $unit_number, 
						'title' => $title, 
						'video' => $video_path
					);
					
					$result = $this->practice_model->add($array);
					if ($result > 0) {
						redirect('/practice');
					}
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id) {
		$result = $this->practice_model->delete($id);
        if ($result > 0) {
			redirect('/practice');
		}
	}

	public function edit($id) {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Practice Title', 'required');
			
			if ($this->form_validation->run() == false) {
				$result['data_unit'] = $this->unit_model->getUnitList();
				$result['data_practice'] = $this->practice_model->get($id);
				$this->load->view('Practice/edit', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$title = $this->input->post('title');
				$change_video = $this->input->post('change_video');
				if ($change_video == 1) {
					if ($_FILES['video']['error'] == UPLOAD_ERR_OK) {
						$tmp_name = $_FILES["video"]["tmp_name"];
						$name = basename($_FILES["video"]["name"]);
						$video_path = 'uploads/practice/' . $name;
						move_uploaded_file($tmp_name, $video_path);
						$array = array(
							'unit_number' => $unit_number, 
							'title' => $title, 
							'video' => $video_path
						);
						
						$result = $this->practice_model->update($id, $array);
						if ($result > 0) {
							redirect('/practice');
						}
					}
				} else {
					$array = array(
						'unit_number' => $unit_number, 
						'title' => $title
					);
					
					$result = $this->practice_model->update($id, $array);
					if ($result > 0) {
						redirect('/practice');
					}
				}
			}
		} else {
			redirect('/login');
		}
	}
}