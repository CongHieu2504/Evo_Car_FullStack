<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
    public function index() {
        $query = $this->input->get('query');
        $data['query'] = $query;
        $this->load->view('search', $data);
    }
} 