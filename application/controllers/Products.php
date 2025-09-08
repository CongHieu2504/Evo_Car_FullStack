<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Products extends CI_Controller {
    public function index() {
        $this->load->model('Posts_model');
        $this->load->database();
        $limit = 6; // Số sản phẩm mỗi trang (giảm còn 6)
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $offset = ($page - 1) * $limit;

        // Lọc
        $brand = $this->input->get('brand');
        $type = $this->input->get('type');
        $sort = $this->input->get('sort');
        $cat = $this->input->get('cat');

        // Lấy toàn bộ danh mục
        $cats = $this->db->get('shops_cat')->result_array();
        // Xây dựng cây cha-con
        $cat_tree = [];
        foreach ($cats as $row) {
            $cat_tree[$row['parent']][] = $row;
        }
        $data['cat_tree'] = $cat_tree;
        $data['cat'] = $cat;

        // Hàm lấy tất cả id con của 1 danh mục (đệ quy)
        function getAllCatIds($cat_tree, $cat_id) {
            $ids = [$cat_id];
            if (!empty($cat_tree[$cat_id])) {
                foreach ($cat_tree[$cat_id] as $child) {
                    $ids = array_merge($ids, getAllCatIds($cat_tree, $child['id']));
                }
            }
            return $ids;
        }

        $filters = [];
        if ($brand) $filters['brand'] = $brand;
        if ($cat) {
            // Lấy tất cả id con của danh mục cha (bao gồm chính nó)
            $cat_ids = getAllCatIds($cat_tree, $cat);
            $filters['cat_id_in'] = $cat_ids;
        } else if ($type) {
            $filters['type'] = $type;
        }
        if ($sort) $filters['sort'] = $sort;

        $data['products'] = $this->Posts_model->get_products($limit, $offset, $filters);
        $data['total_products'] = $this->Posts_model->count_products($filters);
        $data['limit'] = $limit;
        $data['page'] = $page;
        $data['brand'] = $brand;
        $data['type'] = $type;
        $data['sort'] = $sort;
        $this->load->view('products', $data);
    }

    public function detail($product_id = null) {
        // Lấy ID sản phẩm từ URL parameter
        if (!$product_id) {
            // Nếu không có ID, redirect về trang products
            redirect(site_url('products'));
            return;
        }

        // Lấy thông tin sản phẩm từ bảng shops_rows
        $this->load->database();
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
            'price' => 'Liên hệ', // Bảng shops_rows không có cột price
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
        $this->db->select('id, title, homeimgfile, brand, type');
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
            $product['price'] = 'Liên hệ'; // Thêm giá mặc định
        }
        
        return $products;
    }
} 