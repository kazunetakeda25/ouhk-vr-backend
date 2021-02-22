<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class STTT extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('sttt_model');
		$this->load->model('unit_model');
		$this->load->model('practice_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_sttt'] = $this->sttt_model->getAll();
            $this->load->view('ST-and-TT/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function unitSTTT($unit_number)
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_sttt'] = $this->sttt_model->getAllForUnit($unit_number);
            $this->load->view('ST-and-TT/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function practiceSTTT($practice_number)
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_sttt'] = $this->sttt_model->getAllForPractice($practice_number);
            $this->load->view('ST-and-TT/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function add() {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('practice_number', 'Practice Number', 'required');
			$this->form_validation->set_rules('title', 'Answer ST and TT Title', 'required');
			$this->form_validation->set_rules('original_text', 'Original Text', 'required');
			$this->form_validation->set_rules('translated_text', 'Translated Text', 'required');
			
			if ($this->form_validation->run() == false || $_FILES === null) {
				$result['data_unit'] = $this->unit_model->getUnitList();
				$result['data_practice'] = $this->practice_model->getPracticeList();
				$this->load->view('ST-and-TT/add', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$practice_number = $this->input->post('practice_number');
				$title = $this->input->post('title');
				$original_text = $this->input->post('original_text');
				$translated_text = $this->input->post('translated_text');
				$array = array(
					'unit_number' => $unit_number, 
					'practice_number' => $practice_number, 
					'title' => $title, 
					'original_text' => $original_text, 
					'translated_text' => $translated_text
				);
					
				$result = $this->sttt_model->add($array);
				if ($result > 0) {
					redirect('/sttt');
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id) {
		$result = $this->sttt_model->delete($id);
        if ($result > 0) {
			redirect('/sttt');
		}
	}

	public function edit($id) {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('practice_number', 'Practice Number', 'required');
			$this->form_validation->set_rules('title', 'Answer ST and TT Title', 'required');
			$this->form_validation->set_rules('original_text', 'Original Text', 'required');
			$this->form_validation->set_rules('translated_text', 'Translated Text', 'required');
			
			if ($this->form_validation->run() == false) {
				$result['data_unit'] = $this->unit_model->getUnitList();
				$result['data_practice'] = $this->practice_model->getPracticeList();
				$result['data_sttt'] = $this->sttt_model->get($id);
				$this->load->view('ST-and-TT/edit', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$practice_number = $this->input->post('practice_number');
				$title = $this->input->post('title');
				$original_text = $this->input->post('original_text');
				$translated_text = $this->input->post('translated_text');
				$array = array(
					'unit_number' => $unit_number, 
					'practice_number' => $practice_number, 
					'title' => $title, 
					'original_text' => $original_text, 
					'translated_text' => $translated_text
				);
				
				$result = $this->sttt_model->update($id, $array);
				if ($result > 0) {
					redirect('/sttt');
				}
			}
		} else {
			redirect('/login');
		}
	}
}