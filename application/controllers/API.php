<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    public function getUnitLearningContent()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('id, unit_number, title, data');
    	$this->db->from('tbl_learning_content');
		$this->db->where('unit_number', $unitNumber);
		
		$result = $this->db->get()->result();
        if (count($result) > 0) {
            echo json_encode($result[0], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        } else {
            echo json_encode(null, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }
    }

    public function getUnitLecture()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('id, unit_number, title, mp3, mp4');
    	$this->db->from('tbl_lecture');
		$this->db->where('unit_number', $unitNumber);
		
		$result = $this->db->get()->result();
        if (count($result) > 0) {
            echo json_encode($result[0], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        } else {
            echo json_encode(null, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }
    }

    public function getUnitPractices()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('id, unit_number, number, title, video');
    	$this->db->from('tbl_practice');
		$this->db->where('unit_number', $unitNumber);
		
		$result = $this->db->get()->result();
        
        $data = new stdClass();
        $data->list = $result;
        echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    public function getPracticeGlossaries()
    {
        $practiceNumber = $this->input->post('practiceNumber');
        $this->db->select('id, unit_number, practice_number, title, original_word, translated_word');
    	$this->db->from('tbl_glossary');
		$this->db->where('practice_number', $practiceNumber);
		
		$result = $this->db->get()->result();
        
        $data = new stdClass();
        $data->list = $result;
        echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    public function getPracticeAnswers()
    {
        $practiceNumber = $this->input->post('practiceNumber');
        $this->db->select('id, unit_number, practice_number, title, original_text, translated_text');
    	$this->db->from('tbl_sttt');
		$this->db->where('practice_number', $practiceNumber);
		
		$result = $this->db->get()->result();
        
        $data = new stdClass();
        $data->list = $result;
        echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    public function getUnitAnswers()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('id, unit_number, practice_number, title, original_text, translated_text');
    	$this->db->from('tbl_sttt');
		$this->db->where('unit_number', $unitNumber);
		
		$result = $this->db->get()->result();
        
        $data = new stdClass();
        $data->list = $result;
        echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    public function getUnitForums()
    {
        $unitNumber = $this->input->post('unitNumber');
        $this->db->select('id, unit_number, title, content');
    	$this->db->from('tbl_sttt');
		$this->db->where('unit_number', $unitNumber);
		
		$result = $this->db->get()->result();
        
        $data = new stdClass();
        $data->list = $result;
        echo json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}
