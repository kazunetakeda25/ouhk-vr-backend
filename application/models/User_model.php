<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	public function createUser($username, $email, $password)
	{
		$data = array(
			'username'   => $username,
			'email'      => $email,
			'password'   => $this->hashPassword($password),
			'role'   => 1,
			'status'   => 0,
			'created_at' => date('Y-m-j H:i:s'),
		);

		return $this->db->insert('tbl_user', $data);
	}

	public function resolveLogin($email, $password)
	{
		$this->db->select('password');
		$this->db->from('tbl_user');
		$this->db->where('email', $email);
		$this->db->where('role >', 1);
		$this->db->where('status', 1);
		$this->db->where('is_deleted', 0);

		$hash = $this->db->get()->row('password');

		return $this->verifyPasswordHash($password, $hash);
	}

	public function getUserIdFromEmail($email)
	{
		$this->db->select('id');
		$this->db->from('tbl_user');
		$this->db->where('email', $email);
		$this->db->where('is_deleted', 0);

		return $this->db->get()->row('id');
	}

	public function getUser($user_id)
	{
		$this->db->from('tbl_user');
		$this->db->where('id', $user_id);
		$this->db->where('is_deleted', 0);

		return $this->db->get()->row();
	}

	public function sendVerificationCode($email)
	{
		$from = 'ouhkedu@hotmail.com';

		$this->load->library('email');

		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.live.com';
		$config['smtp_user'] = 'ouhkedu@hotmail.com';
		$config['smtp_pass'] = 'OuRadi88';
		$config['smtp_port'] = 587;
		$this->email->initialize($config);

		$this->email->from($from, 'VIP Admin');
		$this->email->to($email);
		$this->email->subject('Please Verify Your Email.');
		$user_id = $this->getUserIdFromEmail($email);
		$user = $this->getUser($user_id);

		if ($user == null) {
			return -1;
		}

		$this->email->message('
		<!DOCTYPE html
			PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		</head>

		<body>

			Hi, <b>reysa</b>!
			<br>
			<br>
			<br>
			<b>Please click below link to reset your password.</b>
			<br>
			<a href="http://localhost/ouhk-vr-backend/reset-password/?hash=wjtgklwhjiohn23512hig8njiejgklwerwerj">Reset
				Password</a>
			<br>
			<br>
			<b>If you cannot open above link from your email inbox, please copy below url in your browser manually.</b>
			<br>
			http://localhost/ouhk-vr-backend/reset-password/?hash=wjtgklwhjiohn23512hig8njiejgklwerwerj
			<br>
			<br>
			<br>
			Best,
			<br>
			VIP Developer Team
			<br>

		</body>

		</html>
		');

		return $this->email->send();
	}

	private function hashPassword($password)
	{
		return password_hash($password, PASSWORD_BCRYPT);
	}

	private function verifyPasswordHash($password, $hash)
	{
		return password_verify($password, $hash);
	}

	public function getAll()
	{
		$this->db->select('id, username, email, role, status, created_at');
		$this->db->where("is_deleted", "0");
		$this->db->where("role !=", "3");
		$this->db->from('tbl_user');

		return $this->db->get()->result();
	}

	public function add($user)
	{
		$data = array(
			'username' => $user['username'],
			'email' => $user['email'],
			'password' => $user['password'],
			'role' => $user['role'],
			'status' => $user['status'],
			'photo' => $user['photo'],
			'created_at' => date("Y-m-d H:i:s")
		);

		$this->db->select('id');
		$this->db->from('tbl_user');
		$this->db->where('username', $user['username']);
		$this->db->or_where('email', $user['email']);
		$query = $this->db->get();
		$num = $query->num_rows();
		if ($num > 0) {
			return 0;
		} else {
			$this->db->insert('tbl_user', $data);
			return $this->db->insert_id();
		}
	}

	public function get($id)
	{
		$this->db->select('id, username, email, role, status, photo, created_at');
		$this->db->from('tbl_user');
		$this->db->where('id', $id);

		$result = $this->db->get()->result();
		return $result[0];
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'is_deleted' => 1,
			'deleted_at' => date('Y-m-j H:i:s')
		);
		$this->db->update('tbl_user', $data);
		return $this->db->affected_rows();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_user', $data);
		return $this->db->affected_rows();
	}
}
