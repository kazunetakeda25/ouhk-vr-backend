<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('unit_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') === true) {
			$res['data_unit'] = $this->unit_model->getAll();
			$this->load->view('Unit/index', $res);
		} else {
			redirect('/login');
		}
	}

	public function add()
	{
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Unit Title', 'required');
			$this->form_validation->set_rules('description', 'Unit Description', 'required');

			if ($this->form_validation->run() == false) {
				$this->load->view('Unit/add');
			} else {
				$number = $this->input->post('number');
				$title = $this->input->post('title');
				$description = $this->input->post('description');

				$data = array(
					'number' => $number,
					'title' => $title,
					'description' => $description
				);

				$result = $this->unit_model->add($data);
				if ($result > 0) {
					redirect('/unit');
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id)
	{
		$result = $this->unit_model->delete($id);
		if ($result > 0) {
			redirect('/unit');
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Unit Title', 'required');
			$this->form_validation->set_rules('description', 'Unit Description', 'required');

			if ($this->form_validation->run() == false) {
				$res['data_unit'] = $this->unit_model->get($id);
				$this->load->view('Unit/edit', $res);
			} else {
				$number = $this->input->post("number");
				$title = $this->input->post("title");
				$description = $this->input->post("description");

				$data = array(
					'number' => $number,
					'title' => $title,
					'description' => $description
				);

				$result = $this->unit_model->update($id, $data);
				if ($result > 0) {
					redirect('/unit');
				}
			}
		} else {
			redirect('/login');
		}
	}
}
