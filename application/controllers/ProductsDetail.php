<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productsdetail extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        // Test method để kiểm tra controller có hoạt động không
        echo "Productsdetail controller is working!";
        echo "<br>Product ID: " . $this->uri->segment(2);
        return;
        
        // Lấy ID sản phẩm từ URL parameter hoặc segment
        $product_id = $this->uri->segment(2);
        
        if (!$product_id) {
            // Nếu không có ID, redirect về trang products
            redirect(site_url('products'));
            return;
        }

        // Lấy thông tin sản phẩm từ bảng shops_rows
        $this->db->where('id', $product_id);
        $product = $this->db->get('shops_rows')->row_array();
        
        if (!$product) {
            // Nếu không tìm thấy sản phẩm, redirect về trang products
            redirect(site_url('products'));
            return;
        }

        // Chuẩn bị dữ liệu cho view
        $data['product'] = [
            'id' => $product['id'],
            'name' => $product['title'],
            'price' => $product['price'] ?? 'Liên hệ',
            'image' => !empty($product['homeimgfile']) ? 
                (strpos($product['homeimgfile'], '/') === 0 ? $product['homeimgfile'] : base_url('assets/img/' . $product['homeimgfile'])) : 
                base_url('assets/img/no-image.png'),
            'images' => $product['images'] ?? '',
            'interior_images' => $product['interior_images'] ?? '',
            'year' => $product['year'] ?? date('Y'),
            'seats' => $product['seats'] ?? 5,
            'transmission' => $product['transmission'] ?? 'Tự động',
            'details' => $product['hometext'] ?? '',
            'description' => $product['hometext'] ?? '',
            'brand' => $product['brand'] ?? '',
            'category' => $product['type'] ?? 'Sedan',
            'specs' => $this->parse_specs($product),
            'features' => $this->parse_features($product)
        ];

        // Lấy sản phẩm liên quan từ cùng bảng shops_rows
        $related_products = $this->get_related_products($product, 4);
        $data['related_products'] = $related_products;

        $this->load->view('products-detail', $data);
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
        
        // Parse specs từ JSON nếu có
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
        
        // Parse features từ JSON nếu có
        if (!empty($product['features_json'])) {
            $json_features = json_decode($product['features_json'], true);
            if (is_array($json_features)) {
                $features = $json_features;
            }
        }
        
        return $features;
    }

    // Lấy sản phẩm liên quan
    private function get_related_products($current_product, $limit = 4) {
        $this->db->select('id, title, homeimgfile, price, brand, type');
        $this->db->where('id !=', $current_product['id']);
        $this->db->where('status', 'publish');
        $this->db->limit($limit);
        $this->db->order_by('id', 'DESC');
        
        $products = $this->db->get('shops_rows')->result_array();
        
        // Format dữ liệu cho view
        foreach ($products as &$product) {
            $product['image'] = !empty($product['homeimgfile']) ? 
                (strpos($product['homeimgfile'], '/') === 0 ? $product['homeimgfile'] : base_url('assets/img/' . $product['homeimgfile'])) : 
                base_url('assets/img/no-image.png');
        }
        
        return $products;
    }
} 