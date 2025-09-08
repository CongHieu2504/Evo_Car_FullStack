<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        // Controller cực kỳ đơn giản để test
        echo '<h1>Home Controller - OK</h1>';
        echo '<p>Trang chủ hoạt động bình thường</p>';
        echo '<p>Đây là controller Home đơn giản</p>';
        echo '<br><a href="' . base_url('products') . '">Sản phẩm</a> | ';
        echo '<a href="' . base_url('tin-tuc') . '">Tin tức</a> | ';
        echo '<a href="' . base_url('lien-he-moi') . '">Liên hệ</a>';
    }

    // Trang sản phẩm
    function products() {
        $this->load->view('products');
    }

    // Trang tin tức
    function news() {
        $this->load->view('news');
    }

    // Trang liên hệ
    function contact() {
        $this->load->view('contact_form');
    }

    // Trang giới thiệu
    function about() {
        $this->load->view('about');
    }

    // Trang đại lý
    function branch() {
        $this->load->view('branch');
    }

    // Trang đăng ký lái thử
    function register() {
        $this->load->view('register');
    }
} 