<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->database();
	}

	public function getAll() 
	{
		$this->db->select('tbl_forum.id, tbl_forum.unit_number, tbl_forum.title, tbl_forum.content, SUM(tbl_forum_comment.is_deleted = 0) as comments, sum(distinct tbl_forum_comment.like) as likes');
		$this->db->from('tbl_forum');
		$this->db->join('tbl_forum_comment', 'tbl_forum_comment.forum_id = tbl_forum.id', 'left');
		$this->db->where("tbl_forum.is_deleted", "0");
		$this->db->group_by("tbl_forum.id");
		$this->db->order_by("tbl_forum.id", "asc");
		
		return $this->db->get()->result();
	}

	public function add($forum) 
	{
		$data = array(
			'unit_number' => $forum['unit_number'],
			'title' => $forum['title'],
			'content' => $forum['content'],
			'created_at' => date("Y-m-d H:i:s")
		);

		$this->db->insert('tbl_forum', $data);
		return $this->db->insert_id();
	}

	public function getAllForUnit($unit_number) 
	{
		$this->db->select('id, unit_number, title, content');
    	$this->db->from('tbl_forum');
		$this->db->where('unit_number', $unit_number);
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function get($id) 
	{
		$this->db->select('id, unit_number, title, content');
    	$this->db->from('tbl_forum');
		$this->db->where('id', $id);
		
		$result = $this->db->get()->result();
		return $result[0];
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$data = array('is_deleted' => 1,
					  'deleted_at' => date('Y-m-j H:i:s'));
		$this->db->update('tbl_forum', $data);
		return $this->db->affected_rows();
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_forum', $data);
		return $this->db->affected_rows();
	}

	public function getComments($id) 
	{
		$this->db->select('tbl_forum_comment.id, tbl_forum_comment.forum_id, tbl_user.username, tbl_forum_comment.url, tbl_forum_comment.comment, tbl_forum_comment.like');
    	$this->db->from('tbl_forum_comment');
		$this->db->join('tbl_user', 'tbl_user.id = tbl_forum_comment.user_id', 'left');
		$this->db->where('tbl_forum_comment.forum_id', $id);
		$this->db->where("tbl_forum_comment.is_deleted", "0");
		
		$result = $this->db->get()->result();
		return $result;
	}

	public function getComment($id) 
	{
		$this->db->select('id, comment, url, like');
    	$this->db->from('tbl_forum_comment');
		$this->db->where('id', $id);
		
		$result = $this->db->get()->result();
		return $result[0];
	}

	public function deleteComment($id) {
		$this->db->where('id', $id);
		$data = array('is_deleted' => 1,
					  'deleted_at' => date('Y-m-j H:i:s'));
		$this->db->update('tbl_forum_comment', $data);
		return $this->db->affected_rows();
	}

	public function updateComment($id, $data) {
		$this->db->where('id', $id);
		$data['updated_at'] = date('Y-m-j H:i:s');
		$this->db->update('tbl_forum_comment', $data);
		return $this->db->affected_rows();
	}
}

?>