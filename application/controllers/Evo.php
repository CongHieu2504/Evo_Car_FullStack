<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evo extends CI_Controller {
    public function index()
    {
        $this->load->model('posts/M_posts');
        // Lấy 8 sản phẩm mới nhất
        $products = $this->M_posts->gets([
            'post_type' => 'product',
            'status' => 'publish',
            'fields' => ['homeimgfile', 'homeimgalt', 'post_cat_id'],
            'order_by' => ['id' => 'DESC']
        ], 8, 0);
        // Lấy sản phẩm Toyota (thực chất là lấy tất cả sản phẩm post_type = product, không filter brand)
        $toyota_products = $this->M_posts->gets([
            'post_type' => 'product',
            'status' => 'publish',
            'fields' => ['homeimgfile', 'homeimgalt', 'post_cat_id'],
            'order_by' => ['id' => 'DESC']
        ], 20, 0);
        // Lấy banner ở giữa
        $banners = $this->M_posts->gets([
            'post_type' => 'banner',
            'status' => 'publish',
            'fields' => ['homeimgfile', 'homeimgalt', 'post_cat_id'],
            'order_by' => ['id' => 'DESC']
        ], 0, -1);
        // Lấy banner title (đổi thành post_type = 'banner')
        $banner_titles = $this->M_posts->gets([
            'post_type' => 'banner',
            'status' => 'publish',
            'fields' => ['homeimgfile', 'homeimgalt', 'post_cat_id'],
            'order_by' => ['id' => 'DESC']
        ], 0, -1);
        $this->load->view('evo_home', [
            'products' => $products,
            'toyota_products' => $toyota_products,
            'banners' => $banners,
            'banner_titles' => $banner_titles
        ]);
    }

    public function news()
    {
        $this->load->view('news');
    }

    public function about() { $this->load->view('about'); }
    public function products() { $this->load->view('products'); }
    public function contact() { $this->load->view('contact'); }
    public function register() { $this->load->view('register'); }
    public function branch() { $this->load->view('branch'); }
    public function test_menu() {
        $this->load->view('test_menu');
    }
} 