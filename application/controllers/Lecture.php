<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lecture extends CI_Controller
{

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

	public function add()
	{
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Lecture Title', 'required');

			if ($this->form_validation->run() == false || $_FILES === null) {
				$result['data_unit'] = $this->unit_model->getUnitListForContent('tbl_lecture');
				$this->load->view('Lecture/add', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$title = $this->input->post('title');

				$array = array(
					'unit_number' => $unit_number,
					'title' => $title,
				);

				if ($_FILES['mp3'] != null && $_FILES['mp3']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["mp3"]["tmp_name"];
					$name = basename($_FILES["mp3"]["name"]);
					$mp3_path = 'uploads/audio/' . $name;
					move_uploaded_file($tmp_name, $mp3_path);
					$array['mp3'] = $mp3_path;
				}

				if ($_FILES['mp4'] != null && $_FILES['mp4']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["mp4"]["tmp_name"];
					$name = basename($_FILES["mp4"]["name"]);
					$mp4_path = 'uploads/video/' . $name;
					move_uploaded_file($tmp_name, $mp4_path);
					$array['mp4'] = $mp4_path;
				}

				$result = $this->lecture_model->add($array);
				if ($result > 0) {
					redirect('/lecture');
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id)
	{
		$result = $this->lecture_model->delete($id);
		if ($result > 0) {
			redirect('/lecture');
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('unit_number', 'Unit Number', 'required');
			$this->form_validation->set_rules('title', 'Lecture Title', 'required');

			if ($this->form_validation->run() == false) {
				$result['data_unit'] = $this->unit_model->getUnitListForContent('tbl_lecture', $id);
				$result['data_lecture'] = $this->lecture_model->get($id);
				$this->load->view('Lecture/edit', $result);
			} else {
				$unit_number = $this->input->post('unit_number');
				$title = $this->input->post('title');
				$change_mp3 = $this->input->post('change_mp3');
				$change_mp4 = $this->input->post('change_mp4');

				$array = array(
					'unit_number' => $unit_number,
					'title' => $title
				);

				if ($change_mp3 == 1 && $_FILES['mp3']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["mp3"]["tmp_name"];
					$name = basename($_FILES["mp3"]["name"]);
					$mp3_path = 'uploads/audio/' . $name;
					move_uploaded_file($tmp_name, $mp3_path);
					$array['mp3'] = $mp3_path;
				}

				if ($change_mp4 == 1 && $_FILES['mp4']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["mp4"]["tmp_name"];
					$name = basename($_FILES["mp4"]["name"]);
					$mp4_path = 'uploads/video/' . $name;
					move_uploaded_file($tmp_name, $mp4_path);
					$array['mp4'] = $mp4_path;
				}

				$result = $this->lecture_model->update($id, $array);
				if ($result > 0) {
					redirect('/lecture');
				}
			}
		} else {
			redirect('/login');
		}
	}
}
