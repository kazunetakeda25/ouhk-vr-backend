<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	public function get()
	{
		$this->db->select('*');
		$this->db->from('tbl_setting');
		$this->db->where('id', 1);

		$result = $this->db->get()->result();
		return $result[0];
	}

	public function update($data)
	{
		$this->db->where('id', 1);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_setting', $data);
		return $this->db->affected_rows();
	}
}
