<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('setting_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') === true) {
			$res['data_setting'] = $this->setting_model->get();
			$this->load->view('Setting/index', $res);
		} else {
			redirect('/login');
		}
	}
}
