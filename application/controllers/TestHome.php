<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestHome extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo '<h1>Test Home Controller</h1>';
        echo '<p>CodeIgniter hoạt động bình thường</p>';
        echo '<p>PHP Version: ' . PHP_VERSION . '</p>';
        echo '<p>CodeIgniter Version: ' . CI_VERSION . '</p>';
        echo '<br><a href="' . base_url() . '">Về trang chủ</a>';
    }
} 