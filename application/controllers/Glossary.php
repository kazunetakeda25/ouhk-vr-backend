<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Glossary extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('glossary_model');
		$this->load->model('unit_model');
		$this->load->model('practice_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_glossary'] = $this->glossary_model->getAll();
            $this->load->view('Glossary/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function unitGlossary($unit_number)
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_glossary'] = $this->glossary_model->getAllForUnit($unit_number);
            $this->load->view('Glossary/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function practiceGlossary($practice_number)
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_glossary'] = $this->glossary_model->getAllForPractice($practice_number);
            $this->load->view('Glossary/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function add() {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('practice_number', 'Practice Number', 'required');
			$this->form_validation->set_rules('original_word', 'Original Word', 'required');
			$this->form_validation->set_rules('translated_word', 'Translated Word', 'required');
			
			if ($this->form_validation->run() == false || $_FILES === null) {
				$result['data_practice'] = $this->practice_model->getPracticeList();
				$this->load->view('Glossary/add', $result);
			} else {
				$practice_number = $this->input->post('practice_number');
				$original_word = $this->input->post('original_word');
				$translated_word = $this->input->post('translated_word');
				
				$array = array(
					'practice_number' => $practice_number, 
					'original_word' => $original_word, 
					'translated_word' => $translated_word
				);
					
				$result = $this->glossary_model->add($array);
				if ($result > 0) {
					redirect('/glossary');
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id) {
		$result = $this->glossary_model->delete($id);
        if ($result > 0) {
			redirect('/glossary');
		}
	}

	public function edit($id) {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('practice_number', 'Practice Number', 'required');
			$this->form_validation->set_rules('original_word', 'Original Word', 'required');
			$this->form_validation->set_rules('translated_word', 'Translated Word', 'required');
			
			if ($this->form_validation->run() == false) {
				$result['data_practice'] = $this->practice_model->getPracticeList();
				$result['data_glossary'] = $this->glossary_model->get($id);
				$this->load->view('Glossary/edit', $result);
			} else {
				$practice_number = $this->input->post('practice_number');
				$original_word = $this->input->post('original_word');
				$translated_word = $this->input->post('translated_word');
				
				$array = array(
					'practice_number' => $practice_number, 
					'original_word' => $original_word, 
					'translated_word' => $translated_word
				);
						
				$result = $this->glossary_model->update($id, $array);
				if ($result > 0) {
					redirect('/glossary');
				}
			}
		} else {
			redirect('/login');
		}
	}
}