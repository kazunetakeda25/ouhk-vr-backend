<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sttt_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->database();
	}

	public function getAll() 
	{
		$this->db->select('id, practice_number, title');
		$this->db->from('tbl_sttt');
		$this->db->where("is_deleted", "0");
		$this->db->order_by("practice_number", "asc");
		
		return $this->db->get()->result();
	}

	public function add($sttt) 
	{
		$data = array(
			'practice_number' => $sttt['practice_number'],
			'title' => $sttt['title'],
			'ex1_answer_original' => $sttt['ex1_answer_original'], 
			'ex1_answer_translated' => $sttt['ex1_answer_translated'], 
			'ex2_answer_original' => $sttt['ex2_answer_original'], 
			'ex2_answer_translated' => $sttt['ex2_answer_translated'], 
			'created_at' => date("Y-m-d H:i:s")
		);

		$this->db->insert('tbl_sttt', $data);
		return $this->db->insert_id();
	}

	public function getAllForUnit($unit_number) 
	{
		$this->db->select('tbl_sttt.id, tbl_sttt.practice_number, tbl_sttt.title');
    	$this->db->from('tbl_sttt');
		$this->db->join('tbl_practice', 'tbl_practice.unit_number = ' . $unit_number, 'left');
		$this->db->where('tbl_practice.unit_number', $unit_number);
		$this->db->order_by("practice_number", "asc");
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function getAllForPractice($practice_number) 
	{
		$this->db->select('id, practice_number, title');
    	$this->db->from('tbl_sttt');
		$this->db->where('practice_number', $practice_number);
		$this->db->order_by("practice_number", "asc");
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function get($id) 
	{
		$this->db->select('id, practice_number, title, ex1_answer_original, ex1_answer_translated, ex2_answer_original, ex2_answer_translated');
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
