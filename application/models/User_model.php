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

	public function resolveAdminLogin($email, $password)
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

	public function resolveLogin($email, $password)
	{
		$this->db->select('password');
		$this->db->from('tbl_user');
		$this->db->where('email', $email);
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
	
	public function verifyHash($hash)
	{
	    $this->db->from('tbl_user');
		$this->db->where('hash', $hash);
		$this->db->where('is_deleted', 0);

		$result = $this->db->get()->result();
		if (count($result) == 0)
		    return false;
		    
		$this->db->where('id', $result[0]->id);
		$data['status'] = 1;
		$this->db->update('tbl_user', $data);
		return $this->db->affected_rows();
	}

	public function sendVerificationCode($email)
	{
		$from = 'ouhkedu@hotmail.com';

		$this->load->library('email');

        $mail_config = array();
		$mail_config['smtp_host'] = 'smtp.live.com';
        $mail_config['smtp_port'] = '587';
        $mail_config['smtp_user'] = 'ouhkedu@hotmail.com';
        $mail_config['_smtp_auth'] = TRUE;
        $mail_config['smtp_pass'] = 'OuRadi88';
        $mail_config['smtp_crypto'] = 'tls';
        $mail_config['protocol'] = 'smtp';
        $mail_config['mailtype'] = 'html';
        $mail_config['charset'] = 'utf-8';
        $mail_config['wordwrap'] = TRUE;
        $this->email->initialize($mail_config);
        
        $this->email->set_newline("\r\n");
		
		$this->email->from($from, 'VIP Admin');
		$this->email->to($email);
		$this->email->subject('Please Verify Your Email.');
		$user_id = $this->getUserIdFromEmail($email);
		$user = $this->getUser($user_id);

		if ($user == null) {
			return -1;
		}

		$code = strtoupper($this->generateCode(8));
		$data = array(
			'code' => $code
		);
		$this->update($user_id, $data);

		$this->email->message('
		<!DOCTYPE html>
		<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		</head>

		<body>

			Hi, <b>' . $user->username . '</b>!
			<br>
			<br>
			Please copy below code and paste it in your browser/app to reset your password.
			<br>
			<p style="font-size: 24px">' . $code . '</p>
			<br>
			Best,
			<br>
			VIP Developer Team
			<br>

		</body>

		</html>
		');

		if ($this->email->send()) {
		    return 1;
        } else {
            show_error($this->email->print_debugger());
            return 0;
        }
	}
	
	public function sendEmailVerifyLink($email)
	{
		$from = 'ouhkedu@hotmail.com';

		$this->load->library('email');

        $mail_config = array();
		$mail_config['smtp_host'] = 'smtp.live.com';
        $mail_config['smtp_port'] = '587';
        $mail_config['smtp_user'] = 'ouhkedu@hotmail.com';
        $mail_config['_smtp_auth'] = TRUE;
        $mail_config['smtp_pass'] = 'OuRadi88';
        $mail_config['smtp_crypto'] = 'tls';
        $mail_config['protocol'] = 'smtp';
        $mail_config['mailtype'] = 'html';
        $mail_config['wordwrap'] = TRUE;
        $this->email->initialize($mail_config);
        
        $this->email->set_newline("\r\n");
		
		$this->email->from($from, 'VIP Admin');
		$this->email->to($email);
		$this->email->subject('Please Verify Your Email.');
		$user_id = $this->getUserIdFromEmail($email);
		$user = $this->getUser($user_id);

		if ($user == null) {
			return -1;
		}

		$hash = $this->generateHash(8);
		$data = array(
			'hash' => $hash
		);
		$this->update($user_id, $data);

		$this->email->message('
		<!DOCTYPE html>
		<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		</head>

		<body>

			<p>Hi, <b>' . $user->username . '</b>!</p>
			<p>Please copy this url in your browser manually to continue login.</p>
			' . base_url() . 'email-verify/?hash=' . $hash . '
			<br>
			<br>
			Best,
			<br>
			VIP Developer Team
			<br>

		</body>

		</html>
		');
		
// 		$this->email->message('
// 		<!DOCTYPE html>
// 		<html>

// 		<head>
// 			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
// 		</head>

// 		<body>

// 			<p>Hi, <b>' . $user->username . '</b>!</p>
// 			<p>Please click below link to reset your password.</p>
// 			<p><a href="' . base_url() . 'email-verify/?hash=' . $hash . '">Verify Your Email</a></p>
// 			<p>If you cannot open above link from your email inbox, please copy this url in your browser manually.</p>
// 			<br>
// 			' . base_url() . 'email-verify/?hash=' . $hash . '
// 			<br>
// 			<br>
// 			Best,
// 			<br>
// 			VIP Developer Team
// 			<br>

// 		</body>

// 		</html>
// 		');

		if ($this->email->send()) {
		    return 1;
        } else {
            //show_error($this->email->print_debugger());
            return 0;
        }
	}

	private function generateCode($digits)
	{
		$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$input_length = strlen($permitted_chars);
		$random_string = '';
		for ($i = 0; $i < $digits; $i++) {
			$random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}

		return $random_string;
	}
	
	private function generateHash($digits)
	{
		$permitted_chars = '0123456789';

		$input_length = strlen($permitted_chars);
		$random_string = '';
		for ($i = 0; $i < $digits; $i++) {
			$random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}

		return $random_string;
	}

	private function hashPassword($password)
	{
		return password_hash($password, PASSWORD_BCRYPT);
	}

	private function verifyPasswordHash($password, $hash)
	{
		return password_verify($password, $hash);
	}

	public function resetPassword($id, $code, $password)
	{
		$this->db->select('code');
		$this->db->from('tbl_user');
		$this->db->where('code', $code);
		$this->db->where('id', $id);
		$this->db->where('is_deleted', 0);

		$result = $this->db->get()->result();
		if ($result != null && count($result) > 0) {
			$data = array(
				'password'   => $this->hashPassword($password),
				'updated_at' => date('Y-m-j H:i:s'),
			);

			return $this->update($id, $data);
		}

		return false;
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
