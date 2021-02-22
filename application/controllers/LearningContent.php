<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LearningContent extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('learningcontent_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_learning_content'] = $this->learningcontent_model->getAll();
            $this->load->view('Learning-Content/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function add() {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Learning Content Title', 'required');
			$this->form_validation->set_rules('data', 'Learning Content Data', 'required');
			
			if ($this->form_validation->run() == false) {
				$this->load->view('Learning-Content/add');
			} else {
				$unit_number = $this->input->post('unit_number');
				$title = $this->input->post('title');
				$data = $this->input->post('data');

				$array = array(
					'unit_number' => $unit_number, 
					'title' => $title, 
					'data' => $data
				);
				
				$result = $this->learningcontent_model->add($array);
				if ($result > 0) {
					redirect('/learning-content');
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id) {
		$result = $this->learningcontent_model->delete($id);
        if ($result > 0) {
			redirect('/learning-content');
		}
	}

	public function edit($id) {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Learning Content Title', 'required');
			$this->form_validation->set_rules('data', 'Learning Content Data', 'required');
			
			if ($this->form_validation->run() == false) {
				$result['data_learning_content'] = $this->learningcontent_model->get($id);
				$this->load->view('Learning-Content/edit', $result);
			} else {
				$unit_number = $this->input->post("unit_number");
				$title = $this->input->post("title");
				$data = $this->input->post("data");
				
				$array = array(
					'unit_number' => $unit_number, 
					'title' => $title, 
					'data' => $data
				);
				
				$result = $this->learningcontent_model->update($id, $array);
				if ($result > 0) {
					redirect('/learning-content');
				}
			}
		} else {
			redirect('/login');
		}
	}
}
