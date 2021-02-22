<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class STTT_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->database();
	}

	public function getAll() 
	{
		$this->db->select('id, unit_number, practice_number, title');
		$this->db->from('tbl_sttt');
		$this->db->where("is_deleted", "0");
		$this->db->order_by("unit_number", "asc");
		$this->db->order_by("unit_number", "asc");
		$this->db->order_by("id", "asc");
		
		return $this->db->get()->result();
	}

	public function add($sttt) 
	{
		$data = array(
			'unit_number' => $sttt['unit_number'],
			'practice_number' => $sttt['practice_number'],
			'title' => $sttt['title'],
			'original_text' => $sttt['original_text'], 
			'translated_text' => $sttt['translated_text'], 
			'created_at' => date("Y-m-d H:i:s")
		);

		$this->db->insert('tbl_sttt', $data);
		return $this->db->insert_id();
	}

	public function getAllForUnit($unit_number) 
	{
		$this->db->select('id, unit_number, practice_number, title');
    	$this->db->from('tbl_sttt');
		$this->db->where('unit_number', $unit_number);
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function getAllForPractice($practice_number) 
	{
		$this->db->select('id, unit_number, practice_number, title');
    	$this->db->from('tbl_sttt');
		$this->db->where('practice_number', $practice_number);
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function get($id) 
	{
		$this->db->select('id, unit_number, practice_number, title, original_text, translated_text');
    	$this->db->from('tbl_sttt');
		$this->db->where('id', $id);
		
		$result = $this->db->get()->result();
		return $result[0];
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$data = array('is_deleted' => 1,
					  'deleted_at' => date('Y-m-j H:i:s'));
		$this->db->update('tbl_sttt', $data);
		return $this->db->affected_rows();
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_sttt', $data);
		return $this->db->affected_rows();
	}
}

?>