<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('user_model');
	}

	public function login() 
	{
		if ($this->session->userdata('logged_in') === true) {
			redirect('/unit');
		} else {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('message', validation_errors());
				$this->load->view('Auth/login');
			} else {
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				if ($this->user_model->resolveAdminLogin($email, $password)) {
					$user_id = $this->user_model->getUserIdFromEmail($email);
					$user    = $this->user_model->getUser($user_id);

					$this->session->set_userdata('user_id', (int)$user->id);
					$this->session->set_userdata('username', (string)$user->username);
					$this->session->set_userdata('email', (string)$user->email);
					$this->session->set_userdata('photo', (string)$user->photo);
					$this->session->set_userdata('role', (string)$user->role);
					$this->session->set_userdata('logged_in', (bool)true);
					
					redirect('/unit');
				} else {
					$this->session->set_flashdata('message', "Unable to login. Check if your user credential correct or check if you are Administrator.");
					$this->load->view('Auth/login');
				}
			}
		}
	}
	
	public function register() 
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[tbl_user.username]', 
			array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_user.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]');

		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('message', validation_errors());
			$this->load->view('Auth/register');
		} else {
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			
		    if ($this->user_model->createUser($username, $email, $password)) {
		        $result = $this->user_model->sendEmailVerifyLink($email);
		        if ($result == 1) {
				    $this->session->set_flashdata('message', "User registered successfully. Please check your inbox to verify your email.");
				    $this->load->view('Auth/register');
		        }else {
    			    $this->session->set_flashdata('message', "Unable to send email.");
    				$this->load->view('Auth/register');
    			}
				
			} else {
				$this->session->set_flashdata('message', "Same user with username or email already exists.");
				$this->load->view('Auth/register');
			}
		}
	}

	public function forgotPassword() 
	{
		if ($this->session->userdata('logged_in') === true) {
			redirect('/unit');
		} else {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('message', validation_errors());
				$this->load->view('Auth/forgotPassword');
			} else {
				$email = $this->input->post('email');
				$userid = $this->user_model->getUserIdFromEmail($email);
				if ($userid == null) {
				    $this->session->set_flashdata('message', "User does not exist.");
					$this->load->view('Auth/forgotPassword');
					return;
				}
				
				$result = $this->user_model->sendVerificationCode($email);
				if ($result == 1) {
				    $this->session->set_userdata('tmp_userid', (int)$userid);
				    redirect('/reset-password');
				} else {
					$this->session->set_flashdata('message', "Unable to send verification code to your email.");
					$this->load->view('Auth/forgotPassword');
				}
			}
		}
	}

	public function resetPassword() 
	{
		if ($this->session->userdata('logged_in') === true) {
			redirect('/unit');
		} else {
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('code', 'Code', 'required');
			$this->form_validation->set_rules('password', 'New Password', 'trim|required');
			$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]');
			
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('message', validation_errors());
				$this->load->view('Auth/resetPassword');
			} else {
				$tmp_userid = $this->session->userdata('tmp_userid');
				$code = $this->input->post('code');
				$password = $this->input->post('password');

				$result = $this->user_model->resetPassword($tmp_userid, $code, $password);
				if ($result == true) {
					redirect('/login');
				} else {
					$this->session->set_flashdata('message', "Unable to reset your password.");
					$this->load->view('Auth/resetPassword');
				}
			}
		}
	}
	
	public function emailVerify() 
	{
		$hash = $this->input->get('hash');
	    $result = $this->user_model->verifyHash($hash);
		if ($result == true) {
			redirect('/login');
		} else {
			redirect('/register');
		}
	}

	public function logout() 
	{
		$this->session->sess_destroy();
		$this->login();
		redirect('/');
	}
}
