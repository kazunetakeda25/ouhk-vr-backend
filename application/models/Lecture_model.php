<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecture_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->database();
	}

	public function getAll() 
	{
		$this->db->select('id, unit_number, title');
		$this->db->from('tbl_lecture');
		$this->db->where("is_deleted", "0");
		$this->db->order_by("unit_number", "asc");
		$this->db->order_by("id", "asc");
		
		return $this->db->get()->result();
	}

	public function add($lecture) 
	{
		$data = array(
			'unit_number' => $lecture['unit_number'],
			'title' => $lecture['title'],
			'mp3' => $lecture['mp3'], 
			'created_at' => date("Y-m-d H:i:s")
		);

		$this->db->insert('tbl_lecture', $data);
		return $this->db->insert_id();
	}

	public function getAllForUnit($unit_number) 
	{
		$this->db->select('id, unit_number, title');
    	$this->db->from('tbl_lecture');
		$this->db->where('unit_number', $unit_number);
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function get($id) 
	{
		$this->db->select('id, unit_number, title, mp3');
    	$this->db->from('tbl_lecture');
		$this->db->where('id', $id);
		
		$result = $this->db->get()->result();
		return $result[0];
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$data = array('is_deleted' => 1,
					  'deleted_at' => date('Y-m-j H:i:s'));
		$this->db->update('tbl_lecture', $data);
		return $this->db->affected_rows();
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_lecture', $data);
		return $this->db->affected_rows();
	}
}

?>