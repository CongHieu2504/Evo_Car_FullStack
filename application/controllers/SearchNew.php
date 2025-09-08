<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchNew extends CI_Controller {
    public function index() {
        $this->load->model('posts/M_posts');
        $query = $this->input->get('q') ?: $this->input->get('query');
        $type = $this->input->get('type');
        $brand = $this->input->get('brand');

        // Chuẩn bị điều kiện lọc
        $args = [
            'post_type' => 'product',
            'status' => 'publish',
            'fields' => ['homeimgfile', 'homeimgalt', 'post_cat_id'] // quay lại fields mặc định
        ]; 
        // Lấy số trang và offset
        $limit = 6;
        $page = max(1, (int)($this->input->get('page') ?? 1));
        $offset = ($page - 1) * $limit;

        // Lấy tất cả sản phẩm product
        $products = $this->M_posts->gets($args, 1000, 0); // lấy tối đa 1000 sản phẩm để filter

        // Hàm chuẩn hóa chuỗi: loại bỏ dấu cách, chuyển về chữ thường
        function normalize($str) {
            return strtolower(str_replace(' ', '', trim($str)));
        }

        // Lọc theo điều kiện tìm kiếm
        $filtered = array_values(array_filter($products, function($item) use ($query, $type, $brand) {
            $ok = true;
            if ($query) {
                $ok = $ok && (
                    stripos($item['title'], $query) !== false ||
                    stripos($item['description'], $query) !== false
                );
            }
            if ($type && strtolower(trim($type)) !== 'all') {
                $itemType = normalize($item['type'] ?? '');
                $filterType = normalize($type);
                $ok = $ok && ($itemType === $filterType);
            }
            if ($brand && strtolower(trim($brand)) !== 'all') {
                $itemBrand = strtolower(trim($item['brand'] ?? ''));
                $filterBrand = strtolower(trim($brand));
                $ok = $ok && ($itemBrand === $filterBrand);
            }
            return $ok;
        }));

        $total_products = count($filtered);
        $total_pages = ceil($total_products / $limit);
        $paged_products = array_slice($filtered, $offset, $limit);

        $data = [
            'query' => $query,
            'type' => $type,
            'brand' => $brand,
            'products' => $paged_products,
            'total_products' => $total_products,
            'total_pages' => $total_pages,
            'current_page' => $page
        ];
        $this->load->view('search_new', $data);
    }
} 