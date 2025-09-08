<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductDetail extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Posts_model');
    }

    public function index() {
        // Lấy ID sản phẩm từ query string
        $product_id = $this->input->get('id');
        
        if (!$product_id) {
            // Nếu không có ID, redirect về trang chủ
            redirect(site_url(''));
            return;
        }

        // Lấy thông tin sản phẩm từ database
        $product = $this->Posts_model->get_product_by_id($product_id);
        
        if (!$product) {
            // Nếu không tìm thấy sản phẩm, redirect về trang chủ
            redirect(site_url(''));
            return;
        }

        // Chuẩn bị dữ liệu cho view
        $data['product'] = [
            'id' => $product['id'],
            'name' => $product['title'],
            'price' => $product['price'] ?? 'Liên hệ',
            'image' => !empty($product['image']) ? $product['image'] : base_url('assets/img/no-image.png'),
            'images' => $product['images'] ?? '',
            'interior_images' => $product['interior_images'] ?? '',
            'year' => $product['year'] ?? date('Y'),
            'seats' => $product['seats'] ?? 5,
            'transmission' => $product['transmission'] ?? 'Tự động',
            'details' => $product['description'] ?? '',
            'description' => $product['description'] ?? '',
            'brand' => $product['brand'] ?? '',
            'category' => $product['type'] ?? 'Sedan',
            'specs' => $this->parse_specs($product),
            'features' => $this->parse_features($product)
        ];

        // Lấy sản phẩm liên quan
        $related_products = $this->Posts_model->get_related_products($product, 4);
        $data['related_products'] = $related_products;

        $this->load->view('product-detail', $data);
    }

    // Parse thông số kỹ thuật từ dữ liệu sản phẩm
    private function parse_specs($product) {
        $specs = [];
        
        // Lấy thông số từ các trường có sẵn
        if (!empty($product['engine'])) {
            $specs['Động cơ'] = $product['engine'];
        }
        if (!empty($product['power'])) {
            $specs['Công suất'] = $product['power'];
        }
        if (!empty($product['torque'])) {
            $specs['Mô-men xoắn'] = $product['torque'];
        }
        if (!empty($product['transmission'])) {
            $specs['Hộp số'] = $product['transmission'];
        }
        if (!empty($product['fuel_consumption'])) {
            $specs['Tiêu thụ nhiên liệu'] = $product['fuel_consumption'];
        }
        
        // Sửa: lấy specs từ trường specs (JSON) thay vì specs_json
        if (!empty($product['specs'])) {
            $json_specs = json_decode($product['specs'], true);
            if (is_array($json_specs)) {
                $specs = array_merge($specs, $json_specs);
            }
        }
        
        return $specs;
    }

    // Parse tính năng từ dữ liệu sản phẩm
    private function parse_features($product) {
        $features = [];
        
        // Nếu có trường features_json, parse từ JSON
        if (!empty($product['features_json'])) {
            $json_features = json_decode($product['features_json'], true);
            if (is_array($json_features)) {
                $features = $json_features;
            }
        }
        
        // Thêm một số tính năng mặc định nếu không có
        if (empty($features)) {
            $features = [
                'Hệ thống phanh ABS',
                'Túi khí đôi',
                'Điều hòa không khí',
                'Hệ thống âm thanh',
                'Camera lùi',
                'Chìa khóa thông minh'
            ];
        }
        
        return $features;
    }
} 