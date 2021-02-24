<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LearningContent_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->database();
	}

	public function getAll() 
	{
		$this->db->select('id, unit_number, title');
		$this->db->from('tbl_learning_content');
		$this->db->where("is_deleted", "0");
		$this->db->order_by("unit_number", "asc");
		$this->db->order_by("id", "asc");
		
		return $this->db->get()->result();
	}

	public function add($learning_content) 
	{
		$this->db->select('unit_number');
    	$this->db->from('tbl_learning_content');
		$this->db->where('unit_number', $learning_content['unit_number']);
		
		$result = $this->db->get()->result();
		if (count($result) > 0)
			return 0;

		$data = array(
			'unit_number' => $learning_content['unit_number'],
			'title' => $learning_content['title'],
			'data' => $learning_content['data'], 
			'created_at' => date("Y-m-d H:i:s")
		);

		$this->db->insert('tbl_learning_content', $data);
		return $this->db->insert_id();
	}

	public function getForUnit($unit_number) 
	{
		$this->db->select('id, unit_number, title, data');
    	$this->db->from('tbl_learning_content');
		$this->db->where('unit_number', $unit_number);
		
		return $this->db->get()->result();
	}

	public function get($id) 
	{
		$this->db->select('id, unit_number, title, data');
    	$this->db->from('tbl_learning_content');
		$this->db->where('id', $id);
		
		$result = $this->db->get()->result();
		return $result[0];
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$data = array('is_deleted' => 1,
					  'deleted_at' => date('Y-m-j H:i:s'));
		$this->db->update('tbl_learning_content', $data);
		return $this->db->affected_rows();
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_learning_content', $data);
		return $this->db->affected_rows();
	}
}
