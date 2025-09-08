<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class News extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Posts_model');
    }

    public function index() {
        $this->load->library('pagination');
        $limit = 8;
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $offset = ($page - 1) * $limit;
        $total = $this->Posts_model->count_news();
        $data['news'] = $this->Posts_model->get_news($limit, $offset);
        $data['total'] = $total;
        $data['limit'] = $limit;
        $data['page'] = $page;
        $data['total_pages'] = ceil($total / $limit);
        $this->load->view('news', $data);
    }
} 