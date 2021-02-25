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

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($this->user_model->resolveLogin($email, $password)) {
            $user_id = $this->user_model->getUserIdFromEmail($email);
            $user = $this->user_model->getUser($user_id);

            $result = new stdClass();
            $result->id = $user->id;
            $result->username = $user->username;
            $result->email = $user->email;

            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            echo json_encode(null, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    public function register()
    {
        $username = $this->input->post('username');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        $result = new stdClass();

        if ($this->user_model->createUser($username, $email, $password)) {
            $result->success = true;
        } else {
            $result->success = false;
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function forgotPassword()
    {
        $email = $this->input->post('email');

        $result = $this->user_model->sendVerificationCode($email);
        $data = new stdClass();
        $data->success = $result;

        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function resetPassword()
    {
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $password = $this->input->post('password');

        $result = $this->user_model->resetPassword($id, $code, $password);
        $data = new stdClass();
        $data->success = $result;

        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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

    public function getForums()
    {
        $this->db->select('tbl_forum.id, tbl_forum.unit_number, tbl_forum.title, tbl_forum.content, count(distinct tbl_forum_comment.id) as comments, sum(distinct tbl_forum_comment.like) as likes');
        $this->db->from('tbl_forum');
        $this->db->join('tbl_forum_comment', 'tbl_forum_comment.forum_id = tbl_forum.id', 'left');
        $this->db->where("tbl_forum.is_deleted", "0");
        $this->db->group_by("tbl_forum.id");
        $this->db->order_by("tbl_forum.id", "asc");

        $result = $this->db->get()->result();

        $data = new stdClass();
        $data->list = $result;
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function getUnitForum()
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

    public function createUnitForumComment()
    {
        $unitNumber = $this->input->post('unitNumber');
        $userId = $this->input->post('userId');
        $comment = $this->input->post('comment');

        $this->db->select('id');
        $this->db->from('tbl_forum');
        $this->db->where("is_deleted", "0");
        $this->db->where("unit_number", $unitNumber);
        $forumId = 0;
        $result = $this->db->get()->result();
        if (count($result) == 0) {
            $data = array(
                'unit_number' => $unitNumber,
                'title' => "Unit " . $unitNumber,
                'content' => "Unit Forum",
                'created_at' => date("Y-m-d H:i:s")
            );
            $this->db->insert('tbl_forum', $data);
            $forumId = $this->db->insert_id();
        } else {
            $forumId = $result[0]->id;
        }

        if ($forumId == 0) {
            $data = new stdClass();
            $data->success = false;
            echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            return;
        }

        $last = $this->db->order_by('id', 'desc')->limit(1)->get('tbl_forum_comment')->row();
        if ($last == null || count($last) == 0)
            $lastId = 0;

        if ($_FILES['recording']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["recording"]["tmp_name"];
            $name = basename($_FILES["recording"]["name"], ".wav");
            $recording_path = 'uploads/audio/recording/' . $name . '_' . ($lastId + 1) . ".wav";

            move_uploaded_file($tmp_name, $recording_path);

            $data = array(
                'forum_id' => $forumId,
                'user_id' => $userId,
                'url' => $recording_path,
                'comment' => $comment,
                'created_at' => date("Y-m-d H:i:s")
            );

            $this->db->insert('tbl_forum_comment', $data);
            $insertId = $this->db->insert_id();
            $data = new stdClass();
            $data->success = $insertId > 0 ? true : false;

            echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            $data = new stdClass();
            $data->success = false;
            echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }
}
