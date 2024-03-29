<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Practice_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	public function getAll()
	{
		$this->db->select('id, unit_number, number, title');
		$this->db->from('tbl_practice');
		$this->db->where("is_deleted", "0");
		$this->db->order_by("unit_number", "asc");
		$this->db->order_by("id", "asc");

		return $this->db->get()->result();
	}

	public function add($practice)
	{
		$data = array(
			'unit_number' => $practice['unit_number'],
			'number' => $practice['number'],
			'title' => $practice['title'],
			'created_at' => date("Y-m-d H:i:s")
		);

		if ($practice['ex1_mp3'] != null) {
			$data['ex1_mp3'] = $practice['ex1_mp3'];
		}

		if ($practice['ex1_mp4'] != null) {
			$data['ex1_mp4'] = $practice['ex1_mp4'];
		}

		if ($practice['ex2_mp3'] != null) {
			$data['ex2_mp3'] = $practice['ex2_mp3'];
		}

		if ($practice['ex2_mp4'] != null) {
			$data['ex2_mp4'] = $practice['ex2_mp4'];
		}

		$this->db->select('id');
		$this->db->from('tbl_practice');
		$this->db->where('number', $practice['number']);
		$query = $this->db->get();
		$num = $query->num_rows();
		if ($num > 0) {
			return 0;
		} else {
			$this->db->insert('tbl_practice', $data);
			return $this->db->insert_id();
		}
	}

	public function getAllForUnit($unit_number)
	{
		$this->db->select('id, unit_number, number, title');
		$this->db->from('tbl_practice');
		$this->db->where('unit_number', $unit_number);

		$result = $this->db->get()->result();
		return $result;
	}

	public function get($id)
	{
		$this->db->select('id, unit_number, number, title, ex1_mp3, ex1_mp4, ex2_mp3, ex2_mp4');
		$this->db->from('tbl_practice');
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
		$this->db->update('tbl_practice', $data);
		return $this->db->affected_rows();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_practice', $data);
		return $this->db->affected_rows();
	}

	public function getPracticeList()
	{
		$this->db->select('number');
		$this->db->from('tbl_practice');
		$this->db->where("is_deleted", "0");
		$this->db->order_by("number", "asc");

		return $this->db->get()->result();
	}

	public function getPracticeListForContent($table_name, $edit_id = null)
	{
		$this->db->select('number');
		$this->db->from('tbl_practice');
		$this->db->where("is_deleted", "0");
		$this->db->order_by("number", "asc");

		$numberArray = array();

		$practices = $this->db->get()->result();
		foreach ($practices as $practice) {
			$this->db->select('id, practice_number');
			$this->db->from($table_name);
			$this->db->where("is_deleted", "0");
			$this->db->where("practice_number", $practice->number);

			$result = $this->db->get()->result();
			if (count($result) == 0) {
				$number = new stdClass();
				$number->number = $practice->number;
				array_push($numberArray, $number);
			} else {
				if ($edit_id != null && $result[0]->id == $edit_id) {
					$number = new stdClass();
					$number->number = $result[0]->practice_number;
					array_push($numberArray, $number);
				}
			}
		}

		return $numberArray;
	}
}
