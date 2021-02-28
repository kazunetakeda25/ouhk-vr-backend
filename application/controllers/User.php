<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('user_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') === true) {
			$res['data_user'] = $this->user_model->getAll();
			$this->load->view('User/index', $res);
		} else {
			redirect('/login');
		}
	}

	public function add()
	{
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('role', 'Role', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == false) {
				$this->load->view('User/add');
			} else {
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$role = $this->input->post('role');
				$status = $this->input->post('status');
				if ($_FILES['photo']['error'] == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["photo"]["tmp_name"];
					$name = basename($_FILES["photo"]["name"]);
					$photo_path = 'uploads/photo/' . $name;
					move_uploaded_file($tmp_name, $photo_path);
					$array = array(
						'username' => $username,
						'email' => $email,
						'role' => $role,
						'status' => $status,
						'photo' => $photo_path
					);

					$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
					$data['password'] = $hashedPassword;

					$result = $this->user_model->add($array);
					if ($result > 0) {
						redirect('/user');
					}
				} else {
					$data = array(
						'username' => $username,
						'email' => $email,
						'role' => $role,
						'status' => $status
					);

					$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
					$data['password'] = $hashedPassword;

					$result = $this->user_model->add($data);
					if ($result > 0) {
						redirect('/user');
					}
				}
			}
		} else {
			redirect('/login');
		}
	}

	public function delete($id)
	{
		$result = $this->user_model->delete($id);
		if ($result > 0) {
			redirect('/user');
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('logged_in') === true) {
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('role', 'Role', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');


			if ($this->form_validation->run() == false) {
				$result['data_user'] = $this->user_model->get($id);
				$this->load->view('User/edit', $result);
			} else {
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$role = $this->input->post('role');
				$status = $this->input->post('status');
				$change_photo = $this->input->post('change_photo');
				if ($change_photo == 1) {
					if ($_FILES['photo']['error'] == UPLOAD_ERR_OK) {
						$tmp_name = $_FILES["photo"]["tmp_name"];
						$name = basename($_FILES["photo"]["name"]);
						$photo_path = 'uploads/photo/' . $name;
						move_uploaded_file($tmp_name, $photo_path);
						$array = array(
							'username' => $username,
							'email' => $email,
							'role' => $role,
							'status' => $status,
							'photo' => $photo_path
						);

						if (!empty($password)) {
							$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
							$array['password'] = $hashedPassword;
						}

						$result = $this->user_model->update($id, $array);
						if ($result > 0) {
							redirect('/user');
						}
					}
				} else {
					$array = array(
						'username' => $username,
						'email' => $email,
						'role' => $role,
						'status' => $status
					);

					if (!empty($password)) {
						$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
						$array['password'] = $hashedPassword;
					}

					$result = $this->user_model->update($id, $array);
					if ($result > 0) {
						redirect('/user');
					}
				}
			}
		} else {
			redirect('/login');
		}
	}
}
