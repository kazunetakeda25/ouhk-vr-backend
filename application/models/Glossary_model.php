<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Glossary_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->database();
	}

	public function getAll() 
	{
		$this->db->select('id, unit_number, practice_number, title, original_word, translated_word');
		$this->db->from('tbl_glossary');
		$this->db->where("is_deleted", "0");
		$this->db->order_by("unit_number", "asc");
		$this->db->order_by("unit_number", "asc");
		$this->db->order_by("id", "asc");
		
		return $this->db->get()->result();
	}

	public function add($glossary) 
	{
		$data = array(
			'unit_number' => $glossary['unit_number'],
			'practice_number' => $glossary['practice_number'],
			'title' => $glossary['title'],
			'original_word' => $glossary['original_word'], 
			'translated_word' => $glossary['translated_word'], 
			'created_at' => date("Y-m-d H:i:s")
		);

		$this->db->insert('tbl_glossary', $data);
		return $this->db->insert_id();
	}

	public function getAllForUnit($unit_number) 
	{
		$this->db->select('id, unit_number, practice_number, title, original_word, translated_word');
    	$this->db->from('tbl_glossary');
		$this->db->where('unit_number', $unit_number);
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function getAllForPractice($practice_number) 
	{
		$this->db->select('id, unit_number, practice_number, title, original_word, translated_word');
    	$this->db->from('tbl_glossary');
		$this->db->where('practice_number', $practice_number);
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function get($id) 
	{
		$this->db->select('id, unit_number, practice_number, title, original_word, translated_word');
    	$this->db->from('tbl_glossary');
		$this->db->where('id', $id);
		
		$result = $this->db->get()->result();
		return $result[0];
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$data = array('is_deleted' => 1,
					  'deleted_at' => date('Y-m-j H:i:s'));
		$this->db->update('tbl_glossary', $data);
		return $this->db->affected_rows();
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_glossary', $data);
		return $this->db->affected_rows();
	}
}

?>