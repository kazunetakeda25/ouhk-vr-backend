<?php
defined('BASEPATH') or exit('No direct script access allowed');

class API extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('session'));
        $this->load->database();

        $this->load->model('user_model');
        $this->load->model('unit_model');
        $this->load->model('learningcontent_model');
        $this->load->model('lecture_model');
        $this->load->model('practice_model');
        $this->load->model('sttt_model');
    }

    public function getUnits()
    {
        $this->db->select('id, number, title');
        $this->db->from('tbl_unit');
        $this->db->where("is_deleted", "0");
        $this->db->order_by("number", "asc");

        $result = $this->db->get()->result();

        $data = new stdClass();
        $data->list = $result;
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function getUnitLearningContent()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('id, unit_number, title, data');
        $this->db->from('tbl_learning_content');
        $this->db->where('unit_number', $unitNumber);
        $this->db->where('is_deleted', '0');
        $this->db->order_by("unit_number", "asc");
        $this->db->order_by("id", "asc");

        $result = $this->db->get()->result();
        if (count($result) > 0) {
            echo json_encode($result[0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo json_encode(null, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    public function getUnitLecture()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('id, unit_number, title, mp3, mp4');
        $this->db->from('tbl_lecture');
        $this->db->where('unit_number', $unitNumber);
        $this->db->where('is_deleted', '0');
        $this->db->order_by("unit_number", "asc");
        $this->db->order_by("id", "asc");

        $result = $this->db->get()->result();
        if (count($result) > 0) {
            echo json_encode($result[0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo json_encode(null, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    public function getUnitPractice()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('id, unit_number, number, title, ex1_mp3, ex1_mp4, ex2_mp3, ex2_mp4');
        $this->db->from('tbl_practice');
        $this->db->where('unit_number', $unitNumber);
        $this->db->where('is_deleted', '0');
        $this->db->order_by("unit_number", "asc");
        $this->db->order_by("id", "asc");

        $result = $this->db->get()->result();
        if (count($result) > 0) {
            echo json_encode($result[0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo json_encode(null, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    public function getPracticeGlossaries()
    {
        $practiceNumber = $this->input->post('practiceNumber');
        $this->db->select('id, practice_number, original_word, translated_word');
        $this->db->from('tbl_glossary');
        $this->db->where('practice_number', $practiceNumber);
        $this->db->where('is_deleted', '0');
        $this->db->order_by("practice_number", "asc");
        $this->db->order_by("id", "asc");

        $result = $this->db->get()->result();

        $data = new stdClass();
        $data->list = $result;
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function getPracticeAnswer()
    {
        $practiceNumber = $this->input->post('practiceNumber');
        $this->db->select('id, practice_number, title, ex1_answer_original, ex1_answer_translated, ex2_answer_original, ex2_answer_translated');
        $this->db->from('tbl_sttt');
        $this->db->where('practice_number', $practiceNumber);
        $this->db->where('is_deleted', '0');
        $this->db->order_by("practice_number", "asc");
        $this->db->order_by("id", "asc");

        $result = $this->db->get()->result();
        if (count($result) > 0) {
            echo json_encode($result[0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo json_encode(null, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    public function getUnitAnswer()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('tbl_sttt.id, tbl_sttt.practice_number, tbl_sttt.title, tbl_sttt.ex1_answer_original, tbl_sttt.ex1_answer_translated, tbl_sttt.ex2_answer_original, tbl_sttt.ex2_answer_translated');
        $this->db->from('tbl_sttt');
        $this->db->join('tbl_practice', 'tbl_practice.number = tbl_sttt.practice_number', 'left');
        $this->db->where('tbl_practice.unit_number', $unitNumber);
        $this->db->where('tbl_sttt.is_deleted', '0');
        $this->db->order_by('tbl_sttt.practice_number');
        $this->db->order_by("tbl_sttt.id", "asc");

        $result = $this->db->get()->result();
        if (count($result) > 0) {
            echo json_encode($result[0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo json_encode(null, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    public function getUnitForums()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('tbl_forum.id, tbl_forum.unit_number, tbl_forum.title, tbl_forum.content, count(distinct tbl_forum_comment.id) as comments, sum(distinct tbl_forum_comment.like) as likes');
		$this->db->from('tbl_forum');
		$this->db->join('tbl_forum_comment', 'tbl_forum_comment.forum_id = tbl_forum.id', 'left');
		$this->db->where("tbl_forum.is_deleted", "0");
        $this->db->where("tbl_forum.unit_number", $unitNumber);
		$this->db->group_by("tbl_forum.id");
		$this->db->order_by("tbl_forum.id", "asc");

        $result = $this->db->get()->result();

        $data = new stdClass();
        $data->list = $result;
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
