<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->database();
	}

	public function getAll() 
	{
		$this->db->from('tbl_unit');
		$this->db->where("is_deleted", "0");
		$this->db->order_by("number", "asc");
		
		return $this->db->get()->result();
	}

	public function add($unit) 
	{
		$data = array(
			'number' => $unit['number'],
			'title' => $unit['title'],
			'description' => $unit['description'], 
			'created_at' => date("Y-m-d H:i:s")
		);

		$this->db->select('id');
    	$this->db->from('tbl_unit');
    	$this->db->where('number', $unit['number']);
    	$query = $this->db->get();
		$num = $query->num_rows();
		if ($num > 0) {
			return 0;
		} else {
			$this->db->insert('tbl_unit', $data);
			return $this->db->insert_id();
		}
	}

	public function get($id) 
	{
		$this->db->select('*');
    	$this->db->from('tbl_unit');
		$this->db->where('id', $id);
		
		$result = $this->db->get()->result();
		return $result[0];
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$data = array('is_deleted' => 1,
					  'deleted_at' => date('Y-m-j H:i:s'));
		$this->db->update('tbl_unit', $data);
		return $this->db->affected_rows();
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_unit', $data);
		return $this->db->affected_rows();
	}
}

?>