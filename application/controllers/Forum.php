<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('forum_model');
		$this->load->model('unit_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_forum'] = $this->forum_model->getAll();
            $this->load->view('Forum/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function add() {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Forum Title', 'required');
			$this->form_validation->set_rules('content', 'Forum Content', 'required');
			
			if ($this->form_validation->run() == false || $_FILES === null) {
				$result['data_unit'] = $this->unit_model->getUnitListForContent('tbl_forum');
				$this->load->view('Forum/add', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$title = $this->input->post('title');
				$content = $this->input->post('content');
				
				$array = array(
					'unit_number' => $unit_number, 
					'title' => $title, 
					'content' => $content
				);
					
				$result = $this->forum_model->add($array);
				if ($result > 0) {
					redirect('/forum');
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id) {
		$result = $this->forum_model->delete($id);
        if ($result > 0) {
			redirect('/forum');
		}
	}

	public function edit($id) {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Forum Title', 'required');
			$this->form_validation->set_rules('content', 'Forum Content', 'required');
			
			if ($this->form_validation->run() == false) {
				$result['data_unit'] = $this->unit_model->getUnitListForContent('tbl_forum', $id);
				$result['data_forum'] = $this->forum_model->get($id);
				$this->load->view('Forum/edit', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$title = $this->input->post('practice_number');
				$content = $this->input->post('title');
				
				$array = array(
					'unit_number' => $unit_number, 
					'title' => $title, 
					'content' => $content
				);
						
				$result = $this->forum_model->update($id, $array);
				if ($result > 0) {
					redirect('/forum');
				}
			}
		} else {
			redirect('/login');
		}
	}
}