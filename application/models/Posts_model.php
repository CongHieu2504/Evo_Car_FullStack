<?php
class Posts_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->model('shops/M_shops_rows', 'M_shops_rows');
    }

    // Lấy danh sách tin tức (đổi thành post_type = 'banner')
    public function get_news($limit = 10, $offset = 0) {
        $this->db->select('id, title, image, description, addtime'); // Thêm select để lấy description
        $this->db->where('is_news', 1);
        $this->db->where('status', 'publish');
        $this->db->where('post_type', 'banner');
        $this->db->order_by('addtime', 'DESC');
        $query = $this->db->get('posts', $limit, $offset);
        return $query->result_array();
    }

    // Đếm tổng số tin tức (đổi thành post_type = 'banner')
    public function count_news() {
        $this->db->where('is_news', 1);
        $this->db->where('status', 'publish');
        $this->db->where('post_type', 'banner');
        return $this->db->count_all_results('posts');
    }

    // Lấy danh sách sản phẩm từ shops_rows
    public function get_products($limit = 20, $offset = 0, $filters = array()) {
        $args = array('status' => 1);
        // Có thể bổ sung filter ở đây nếu cần
        if (!empty($filters['q'])) $args['q'] = $filters['q'];
        if (!empty($filters['cat_id'])) $args['cat_id'] = $filters['cat_id'];
        if (!empty($filters['cat_id_in'])) $args['cat_id_in'] = $filters['cat_id_in'];
        if (!empty($filters['is_featured'])) $args['is_featured'] = $filters['is_featured'];
        if (!empty($filters['is_new'])) $args['is_new'] = $filters['is_new'];
        if (!empty($filters['is_bestseller'])) $args['is_bestseller'] = $filters['is_bestseller'];
        // Lọc theo thương hiệu
        if (!empty($filters['brand'])) $args['brand'] = $filters['brand'];
        // Lọc theo loại
        if (!empty($filters['type'])) $args['type'] = $filters['type'];
        // Sắp xếp
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'az':
                    $args['order_by'] = array('title' => 'ASC');
                    break;
                case 'za':
                    $args['order_by'] = array('title' => 'DESC');
                    break;
                case 'new':
                    // Với shops_rows ưu tiên cột created nếu có
                    $args['order_by'] = array('created' => 'DESC');
                    break;
                case 'price_asc':
                    $args['order_by'] = array('product_price' => 'ASC');
                    break;
                case 'price_desc':
                    $args['order_by'] = array('product_price' => 'DESC');
                    break;
                default:
                    break;
            }
        }
        // Mặc định: mới nhất lên đầu theo created DESC nếu không chọn sort
        if (empty($args['order_by'])) {
            $args['order_by'] = array('created' => 'DESC');
        }
        return $this->M_shops_rows->gets($args, $limit, $offset);
    }

    // Đếm tổng số sản phẩm
    public function count_products($filters = array()) {
        $args = array('status' => 1);
        if (!empty($filters['q'])) $args['q'] = $filters['q'];
        if (!empty($filters['cat_id'])) $args['cat_id'] = $filters['cat_id'];
        return $this->M_shops_rows->counts($args);
    }

    // Lấy chi tiết sản phẩm theo ID (chỉ lấy từ bảng posts cho page Home)
    public function get_product_by_id($id) {
        $this->db->where('id', $id);
        $this->db->where('post_type', 'product');
        $this->db->where('status', 'publish');
        $query = $this->db->get('posts');
        return $query->row_array();
    }

    // Lấy sản phẩm liên quan (cùng brand hoặc type)
    public function get_related_products($current_product, $limit = 4) {
        $this->db->where('post_type', 'product');
        $this->db->where('status', 'publish');
        $this->db->where('id !=', $current_product['id']);
        
        // Ưu tiên sản phẩm cùng brand
        if (!empty($current_product['brand'])) {
            $this->db->group_start();
            $this->db->where('brand', $current_product['brand']);
            if (!empty($current_product['type'])) {
                $this->db->or_where('type', $current_product['type']);
            }
            $this->db->group_end();
        }
        
        $this->db->order_by('addtime', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('posts');
        return $query->result_array();
    }

    // Lấy danh sách loại xe và các model tương ứng
    public function get_types_with_models() {
        $this->db->select('type, title, id');
        $this->db->where('post_type', 'product');
        $this->db->where('status', 'publish');
        $query = $this->db->get('posts');
        $result = $query->result_array();
        $types = [];
        foreach ($result as $row) {
            $type = $row['type'];
            if (!isset($types[$type])) {
                $types[$type] = [];
            }
            $types[$type][] = [
                'title' => $row['title'],
                'id' => $row['id']
            ];
        }
        return $types;
    }

    // Lấy tất cả sản phẩm banner
    public function get_banner_and_title_products() {
        $this->db->where('post_type', 'banner');
        $this->db->where('status', 'publish');
        $this->db->order_by('addtime', 'DESC');
        $query = $this->db->get('posts');
        return $query->result_array();
    }

    // Lấy 1 sản phẩm banner theo id
    public function get_banner_and_title_product_by_id($id) {
        $this->db->where('id', $id);
        $this->db->where('post_type', 'banner');
        $this->db->where('status', 'publish');
        $query = $this->db->get('posts');
        return $query->row_array();
    }

    // Lấy tất cả bài viết magazine
    public function get_magazine_posts() {
        $this->db->where('post_type', 'magazine');
        $this->db->where('status', 'publish');
        $this->db->order_by('addtime', 'DESC');
        $query = $this->db->get('posts');
        return $query->result_array();
    }

    // Lấy 1 bài viết magazine theo id
    public function get_magazine_post_by_id($id) {
        $this->db->where('id', $id);
        $this->db->where('post_type', 'magazine');
        $this->db->where('status', 'publish');
        $query = $this->db->get('posts');
        return $query->row_array();
    }
} 