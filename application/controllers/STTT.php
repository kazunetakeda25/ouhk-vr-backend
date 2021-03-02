<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sttt extends CI_Controller {

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
            $this->load->view('Sttt/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function unitSTTT($unit_number)
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_sttt'] = $this->sttt_model->getAllForUnit($unit_number);
            $this->load->view('Sttt/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function practiceSTTT($practice_number)
	{
		if ($this->session->userdata('logged_in') === true) {
			$result['data_sttt'] = $this->sttt_model->getAllForPractice($practice_number);
            $this->load->view('Sttt/index', $result);
		} else {
			redirect('/login');
		}
	}

	public function add() {
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('practice_number', 'Practice Number', 'required');
			$this->form_validation->set_rules('title', 'Answer ST and TT Title', 'required');
			
			if ($this->form_validation->run() == false || $_FILES === null) {
				$result['data_practice'] = $this->practice_model->getPracticeListForContent('tbl_sttt');
				$this->load->view('Sttt/add', $result);
			} else {
				$practice_number = $this->input->post('practice_number');
				$title = $this->input->post('title');
				$ex1_answer_original = $this->input->post('ex1_answer_original');
				$ex1_answer_translated = $this->input->post('ex1_answer_translated');
				$ex2_answer_original = $this->input->post('ex2_answer_original');
				$ex2_answer_translated = $this->input->post('ex2_answer_translated');
				$array = array(
					'practice_number' => $practice_number, 
					'title' => $title, 
					'ex1_answer_original' => $ex1_answer_original, 
					'ex1_answer_translated' => $ex1_answer_translated,
					'ex2_answer_original' => $ex2_answer_original, 
					'ex2_answer_translated' => $ex2_answer_translated
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
			
			$this->form_validation->set_rules('practice_number', 'Practice Number', 'required');
			$this->form_validation->set_rules('title', 'Answer ST and TT Title', 'required');
			
			if ($this->form_validation->run() == false) {
				$result['data_practice'] = $this->practice_model->getPracticeListForContent('tbl_sttt', $id);
				$result['data_sttt'] = $this->sttt_model->get($id);
				$this->load->view('Sttt/edit', $result);
			} else {
				$practice_number = $this->input->post('practice_number');
				$title = $this->input->post('title');
				$ex1_answer_original = $this->input->post('ex1_answer_original');
				$ex1_answer_translated = $this->input->post('ex1_answer_translated');
				$ex2_answer_original = $this->input->post('ex2_answer_original');
				$ex2_answer_translated = $this->input->post('ex2_answer_translated');
				$array = array(
					'practice_number' => $practice_number, 
					'title' => $title, 
					'ex1_answer_original' => $ex1_answer_original, 
					'ex1_answer_translated' => $ex1_answer_translated,
					'ex2_answer_original' => $ex2_answer_original, 
					'ex2_answer_translated' => $ex2_answer_translated
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