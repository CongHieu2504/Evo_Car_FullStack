<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // Thêm headers để tránh cache
        $this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: 0');
        
        $this->load->database();
        
        // Lấy 8 sản phẩm mới nhất - force fresh query
        $this->db->select('id, title, brand, type, status, addtime, image, description, price');
        $this->db->where('post_type', 'product');
        $this->db->where('status', 'publish');
        $this->db->order_by('addtime', 'DESC'); // Sử dụng addtime để đảm bảo sản phẩm mới nhất
        $this->db->limit(8, 0);
        $products = $this->db->get('posts')->result_array();
        
        // Lấy tất cả sản phẩm Toyota (thực chất là lấy tất cả sản phẩm post_type = product)
        $this->db->select('id, title, brand, type, status, addtime, image, description, price');
        $this->db->where('post_type', 'product');
        $this->db->where('status', 'publish');
        $this->db->order_by('addtime', 'DESC'); // Sử dụng addtime để đảm bảo sản phẩm mới nhất
        $this->db->limit(30, 0);
        $toyota_products = $this->db->get('posts')->result_array();

        // Tính checksum cho danh sách sản phẩm (phát hiện thay đổi tên/giá/trạng thái...)
        $this->db->query('SET SESSION group_concat_max_len = 100000');
        $checksum_query = $this->db->query(
            "SELECT MD5(GROUP_CONCAT(CONCAT_WS('|', id, title, brand, type, status, price) ORDER BY id DESC SEPARATOR ';')) AS checksum\n             FROM posts\n             WHERE post_type = 'product' AND status = 'publish'"
        );
        $products_checksum = '';
        if ($checksum_query && $checksum_query->num_rows() > 0) {
            $row = $checksum_query->row();
            $products_checksum = isset($row->checksum) ? (string)$row->checksum : '';
        }
        
        // Lấy banner ở giữa
        $this->db->select('id, title, status, addtime, image');
        $this->db->where('post_type', 'banner');
        $this->db->where('status', 'publish');
        $this->db->order_by('id', 'DESC');
        $banners = $this->db->get('posts')->result_array();
        
        // Lấy banner title
        $this->db->select('id, title, status, addtime, image');
        $this->db->where('post_type', 'banner');
        $this->db->where('status', 'publish');
        $this->db->order_by('id', 'DESC');
        $banner_titles = $this->db->get('posts')->result_array();
        
        // Tính checksum cho banner trang chủ (toàn bộ banner publish)
        $this->db->query('SET SESSION group_concat_max_len = 100000');
        $checksum_banner_query = $this->db->query(
            "SELECT MD5(GROUP_CONCAT(CONCAT_WS('|', id, title, status) ORDER BY id DESC SEPARATOR ';')) AS checksum\n             FROM posts\n             WHERE post_type = 'banner' AND status = 'publish'"
        );
        $banner_checksum = '';
        if ($checksum_banner_query && $checksum_banner_query->num_rows() > 0) {
            $rowB = $checksum_banner_query->row();
            $banner_checksum = isset($rowB->checksum) ? (string)$rowB->checksum : '';
        }

        $this->load->view('evo_home', [
            'products' => $products,
            'toyota_products' => $toyota_products,
            'banners' => $banners,
            'banner_titles' => $banner_titles,
            'page_timestamp' => time(), // Thêm timestamp để force refresh
            'products_checksum' => $products_checksum,
            'banner_checksum' => $banner_checksum
        ]);
    }

    // Check for updates endpoint
    public function check_updates() {
        $this->load->database();
        $this->db->query('SET SESSION group_concat_max_len = 100000');
        
        $checksum_query = $this->db->query(
            "SELECT MD5(GROUP_CONCAT(CONCAT_WS('|', id, title, brand, type, status, price) ORDER BY id DESC SEPARATOR ';')) AS checksum\n             FROM posts\n             WHERE post_type = 'product' AND status = 'publish'"
        );
        $products_checksum = '';
        if ($checksum_query && $checksum_query->num_rows() > 0) {
            $row = $checksum_query->row();
            $products_checksum = isset($row->checksum) ? (string)$row->checksum : '';
        }
        
        $this->output->set_content_type('application/json');
        echo json_encode([
            'checksum' => $products_checksum,
            'server_time' => time()
        ]);
    }

    // Endpoint realtime: kiểm tra thay đổi banner trang chủ (toàn bộ banner publish)
    public function check_banner_updates() {
        $this->load->database();
        $this->db->query('SET SESSION group_concat_max_len = 100000');
        $q = $this->db->query(
            "SELECT MD5(GROUP_CONCAT(CONCAT_WS('|', id, title, status) ORDER BY id DESC SEPARATOR ';')) AS checksum\n             FROM posts\n             WHERE post_type = 'banner' AND status = 'publish'"
        );
        $checksum = '';
        if ($q && $q->num_rows() > 0) {
            $row = $q->row();
            $checksum = isset($row->checksum) ? (string)$row->checksum : '';
        }
        $this->output->set_content_type('application/json');
        echo json_encode(['checksum' => $checksum, 'server_time' => time()]);
    }

    // Trang sản phẩm
    public function products() {
        $this->load->model('Posts_model');
        $this->load->database();
        $limit = 6;
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
        // Tính checksum tổng thể cho shops_rows (status=1) để realtime
        $this->db->query('SET SESSION group_concat_max_len = 100000');
        $checksum_query = $this->db->query(
            "SELECT MD5(GROUP_CONCAT(CONCAT_WS('|', id, title, brand, type, status, IFNULL(product_price,'')) ORDER BY id DESC SEPARATOR ';')) AS checksum\n             FROM shops_rows\n             WHERE status = 1"
        );
        $products_checksum = '';
        if ($checksum_query && $checksum_query->num_rows() > 0) {
            $row = $checksum_query->row();
            $products_checksum = isset($row->checksum) ? (string)$row->checksum : '';
        }
        $data['products_checksum'] = $products_checksum;
        $this->load->view('products', $data);
    }

    // Trang tin tức
    public function news() {
        $this->load->model('Posts_model');
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
        // Thêm checksum tổng cho tin tức để realtime
        $this->load->database();
        $this->db->query('SET SESSION group_concat_max_len = 100000');
        $checksum_query = $this->db->query(
            "SELECT MD5(GROUP_CONCAT(CONCAT_WS('|', id, title, status) ORDER BY id DESC SEPARATOR ';')) AS checksum\n             FROM posts\n             WHERE post_type = 'banner' AND status = 'publish' AND is_news = 1"
        );
        $news_checksum = '';
        if ($checksum_query && $checksum_query->num_rows() > 0) {
            $row = $checksum_query->row();
            $news_checksum = isset($row->checksum) ? (string)$row->checksum : '';
        }
        $data['news_checksum'] = $news_checksum;
        $this->load->view('news', $data);
    }

    // Endpoint realtime kiểm tra thay đổi tin tức (is_news = 1)
    public function check_news_updates() {
        $this->load->database();
        $this->db->query('SET SESSION group_concat_max_len = 100000');
        $q = $this->db->query(
            "SELECT MD5(GROUP_CONCAT(CONCAT_WS('|', id, title, status) ORDER BY id DESC SEPARATOR ';')) AS checksum\n             FROM posts\n             WHERE post_type = 'banner' AND status = 'publish' AND is_news = 1"
        );
        $checksum = '';
        if ($q && $q->num_rows() > 0) {
            $row = $q->row();
            $checksum = isset($row->checksum) ? (string)$row->checksum : '';
        }
        $this->output->set_content_type('application/json');
        echo json_encode(['checksum' => $checksum, 'server_time' => time()]);
    }

    // Realtime: kiểm tra thay đổi danh sách sản phẩm kho (shops_rows status=1)
    public function check_products_page_updates() {
        $this->load->database();
        $this->db->query('SET SESSION group_concat_max_len = 100000');
        $q = $this->db->query(
            "SELECT MD5(GROUP_CONCAT(CONCAT_WS('|', id, title, brand, type, status, IFNULL(product_price,'')) ORDER BY id DESC SEPARATOR ';')) AS checksum\n             FROM shops_rows\n             WHERE status = 1"
        );
        $checksum = '';
        if ($q && $q->num_rows() > 0) {
            $row = $q->row();
            $checksum = isset($row->checksum) ? (string)$row->checksum : '';
        }
        $this->output->set_content_type('application/json');
        echo json_encode(['checksum' => $checksum, 'server_time' => time()]);
    }

    // Trang liên hệ
    public function contact() {
        $this->load->view('contact_form');
    }

    // Trang giới thiệu
    public function about() {
        $this->load->view('about');
    }

    // Trang đại lý
    public function branch() {
        $this->load->view('branch');
    }

    // Trang đăng ký lái thử
    public function register() {
        $this->load->view('register');
    }

    // Trang tìm kiếm
    public function search($page = 1) {
        $this->load->view('search_new');
    }
} 