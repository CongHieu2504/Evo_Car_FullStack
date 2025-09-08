<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductTitle extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Posts_model');
    }

    public function index() {
        $this->load->library(['form_validation', 'session']);
        $this->load->model('M_contactform');
        $product_id = $this->input->get('id');
        // Xử lý submit bình luận
        if ($this->input->post()) {
            $this->form_validation->set_rules('content', 'Nội dung', 'required|trim');
            $this->form_validation->set_rules('name', 'Họ tên', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
            if ($this->form_validation->run() == TRUE) {
                $data = [
                    'full_name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => '',
                    'address' => '',
                    'subject' => 'Bình luận sản phẩm - ' . $product_id,
                    'message' => $this->input->post('content'),
                    'add_time' => time(),
                    'is_view' => 0,
                    'status' => 1,
                    'view_time' => 0
                ];
                $ok = $this->M_contactform->add($data);
                if ($ok) {
                    $this->session->set_flashdata('comment_success', 'Gửi bình luận thành công!');
                } else {
                    $this->session->set_flashdata('comment_error', 'Có lỗi xảy ra, vui lòng thử lại.');
                }
                redirect(current_url() . '?id=' . $product_id);
            } else {
                $this->session->set_flashdata('comment_error', validation_errors());
                redirect(current_url() . '?id=' . $product_id);
            }
        }
        // Lấy tất cả sản phẩm banner và banner_title
        $products = $this->Posts_model->get_banner_and_title_products();
        $data['products'] = [];
        $data['title'] = 'Tất cả sản phẩm';
        if ($product_id) {
            // Lấy đúng 1 sản phẩm theo id
            $product = $this->Posts_model->get_banner_and_title_product_by_id($product_id);
            if ($product) {
                $data['products'][] = $product;
                $data['title'] = $product['title'];
                // Lấy danh sách liên quan (random 3 sản phẩm khác, trừ sản phẩm hiện tại)
                $related = array_filter($products, function($item) use ($product_id) {
                    return $item['id'] != $product_id;
                });
                shuffle($related);
                $data['related_products'] = array_slice($related, 0, 3);
            } else {
                $data['related_products'] = [];
            }
        } else {
            $data['products'] = $products;
            $data['related_products'] = array_slice($products, 0, 3);
        }
        // Lấy danh sách bình luận cho sản phẩm này
        $comments = [];
        if ($product_id) {
            $comments = $this->M_contactform->get_comments_by_subject('Bình luận sản phẩm - ' . $product_id);
        }
        $data['comments'] = $comments;

        $prev_product = null;
        $next_product = null;
        if ($product_id && !empty($products)) {
            $ids = array_column($products, 'id');
            $current_index = array_search($product_id, $ids);
            if ($current_index !== false) {
                if ($current_index > 0) {
                    $prev_product = $products[$current_index - 1];
                }
                if ($current_index < count($products) - 1) {
                    $next_product = $products[$current_index + 1];
                }
            }
        }
        $data['prev_product'] = $prev_product;
        $data['next_product'] = $next_product;

        $this->load->view('product-title', $data);
    }
} 