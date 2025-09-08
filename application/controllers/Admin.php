<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->database();
    }

    public function index() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            redirect('login');
        }

        // Lấy dữ liệu thống kê từ database
        $data = array(
            'title' => 'Admin Dashboard - Evo Car',
            'user' => $logged_in,
            'stats' => $this->get_stats(),
            'recent_activities' => $this->get_recent_activities()
        );

        $this->load->view('admin/dashboard', $data);
    }

    private function get_stats() {
        $stats = array();

        // Đếm tổng số users
        $this->db->where('active', 1);
        $stats['total_users'] = $this->db->count_all_results('users');

        // Đếm tổng số sản phẩm (posts với post_type = 'product')
        $this->db->where('post_type', 'product');
        $this->db->where('status', 'publish');
        $stats['total_products'] = $this->db->count_all_results('posts');

        // Đếm tổng số tin tức (posts với post_type = 'banner' và is_news = 1)
        $this->db->where('post_type', 'banner');
        $this->db->where('is_news', 1);
        $this->db->where('status', 'publish');
        $stats['total_news'] = $this->db->count_all_results('posts');

        // Đếm tổng số đơn hàng (nếu có bảng shops_order)
        $this->db->select('COUNT(*) as total');
        $query = $this->db->get('shops_order');
        if ($query->num_rows() > 0) {
            $stats['total_orders'] = $query->row()->total;
        } else {
            $stats['total_orders'] = 0;
        }

        return $stats;
    }

    private function get_recent_activities() {
        $activities = array();

        // Lấy users mới đăng ký (5 user gần nhất)
        $this->db->select('userid, username, full_name, created');
        $this->db->where('active', 1);
        $this->db->order_by('created', 'DESC');
        $this->db->limit(3);
        $recent_users = $this->db->get('users')->result_array();

        foreach ($recent_users as $user) {
            $activities[] = array(
                'type' => 'user',
                'title' => 'User mới đăng ký',
                'description' => $user['full_name'] . ' đã đăng ký tài khoản',
                'time' => $this->time_ago($user['created']),
                'badge' => 'primary'
            );
        }

        // Lấy sản phẩm mới (5 sản phẩm gần nhất)
        $this->db->select('id, title, addtime');
        $this->db->where('post_type', 'product');
        $this->db->where('status', 'publish');
        $this->db->order_by('addtime', 'DESC');
        $this->db->limit(3);
        $recent_products = $this->db->get('posts')->result_array();

        foreach ($recent_products as $product) {
            $activities[] = array(
                'type' => 'product',
                'title' => 'Sản phẩm mới',
                'description' => $product['title'] . ' đã được thêm vào hệ thống',
                'time' => $this->time_ago($product['addtime']),
                'badge' => 'success'
            );
        }

        // Sắp xếp theo thời gian
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, 6); // Lấy 6 hoạt động gần nhất
    }

    private function time_ago($timestamp) {
        $time_ago = time() - $timestamp;
        
        if ($time_ago < 60) {
            return 'Vừa xong';
        } elseif ($time_ago < 3600) {
            $minutes = floor($time_ago / 60);
            return $minutes . ' phút trước';
        } elseif ($time_ago < 86400) {
            $hours = floor($time_ago / 3600);
            return $hours . ' giờ trước';
        } else {
            $days = floor($time_ago / 86400);
            return $days . ' ngày trước';
        }
    }

    public function users() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            redirect('login');
        }

        // Lấy thống kê users từ database
        $stats = array();
        
        // Tổng số users
        $stats['total_users'] = $this->db->count_all_results('users');
        
        // Users hoạt động
        $this->db->where('active', 1);
        $stats['active_users'] = $this->db->count_all_results('users');
        
        // Users admin
        $this->db->where('role', 'ADMIN');
        $stats['admin_users'] = $this->db->count_all_results('users');
        
        // Users member
        $this->db->where('role', 'MEMBER');
        $stats['member_users'] = $this->db->count_all_results('users');

        // Lấy danh sách tất cả users từ database
        $this->db->select('userid, username, full_name, email, phone, role, active, created');
        $this->db->order_by('created', 'DESC');
        $users = $this->db->get('users')->result();

        $data = array(
            'title' => 'Quản lý User - Admin Dashboard',
            'user' => $logged_in,
            'stats' => $stats,
            'users' => $users
        );

        $this->load->view('admin/users', $data);
    }

    // Xem chi tiết user
    public function view() {
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Chưa đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $user_id = $this->input->post('user_id');
        $user = $this->db->where('userid', $user_id)->get('users')->row();
        
        if ($user) {
            $html = '
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username:</label>
                        <p class="form-control-plaintext">'.$user->username.'</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ và tên:</label>
                        <p class="form-control-plaintext">'.$user->full_name.'</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email:</label>
                        <p class="form-control-plaintext">'.$user->email.'</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số điện thoại:</label>
                        <p class="form-control-plaintext">'.$user->phone.'</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role:</label>
                        <p class="form-control-plaintext">'.$user->role.'</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Trạng thái:</label>
                        <p class="form-control-plaintext">'.($user->active == 1 ? 'Hoạt động' : 'Không hoạt động').'</p>
                    </div>
                </div>
            </div>';
            echo $html;
        } else {
            echo '<div class="alert alert-danger">Không tìm thấy thông tin user!</div>';
        }
    }

    // Form chỉnh sửa user
    public function edit() {
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Chưa đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $user_id = $this->input->post('user_id');
        $user = $this->db->where('userid', $user_id)->get('users')->row();
        
        if ($user) {
            $html = '
            <input type="hidden" name="user_id" value="'.$user->userid.'">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username:</label>
                        <input type="text" class="form-control" name="username" value="'.$user->username.'" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ và tên:</label>
                        <input type="text" class="form-control" name="full_name" value="'.$user->full_name.'" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email:</label>
                        <input type="email" class="form-control" name="email" value="'.$user->email.'" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số điện thoại:</label>
                        <input type="text" class="form-control" name="phone" value="'.$user->phone.'" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role:</label>
                        <select class="form-select" name="role" required>
                            <option value="MEMBER" '.($user->role == 'MEMBER' ? 'selected' : '').'>Member</option>
                            <option value="MANAGER" '.($user->role == 'MANAGER' ? 'selected' : '').'>Manager</option>
                            <option value="ADMIN" '.($user->role == 'ADMIN' ? 'selected' : '').'>Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Trạng thái:</label>
                        <select class="form-select" name="active" required>
                            <option value="1" '.($user->active == 1 ? 'selected' : '').'>Hoạt động</option>
                            <option value="0" '.($user->active == 0 ? 'selected' : '').'>Không hoạt động</option>
                        </select>
                    </div>
                </div>
            </div>';
            echo $html;
        } else {
            echo '<div class="alert alert-danger">Không tìm thấy thông tin user!</div>';
        }
    }

    // Cập nhật user
    public function update() {
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Chưa đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $user_id = $this->input->post('user_id');
        $data = array(
            'username' => $this->input->post('username'),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'role' => $this->input->post('role'),
            'active' => $this->input->post('active'),
            'modified' => time()
        );

        $this->db->where('userid', $user_id);
        $result = $this->db->update('users', $data);

        $response = array();
        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Cập nhật thành công!';
        } else {
            $response['success'] = false;
            $response['message'] = 'Có lỗi xảy ra khi cập nhật!';
        }

        echo json_encode($response);
    }

    // Xóa user
    public function delete() {
        // Debug: log request
        error_log("Delete user request received");
        
        if (!$this->session->userdata('logged_in')) {
            error_log("User not logged in");
            $response = array('success' => false, 'message' => 'Chưa đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        error_log("Logged in user: " . json_encode($logged_in));
        
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            error_log("User not admin, role: " . (isset($logged_in['role']) ? $logged_in['role'] : 'not set'));
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $user_id = $this->input->post('user_id');
        error_log("Attempting to delete user_id: " . $user_id);
        
        if (!$user_id) {
            error_log("No user_id provided");
            $response = array('success' => false, 'message' => 'Thiếu ID user!');
            echo json_encode($response);
            return;
        }
        
        // Không cho phép xóa chính mình
        if ($user_id == $logged_in['userid']) {
            error_log("Attempting to delete self");
            $response = array('success' => false, 'message' => 'Không thể xóa tài khoản của chính mình!');
            echo json_encode($response);
            return;
        }

        // Kiểm tra user có tồn tại không
        $user_exists = $this->db->where('userid', $user_id)->get('users')->num_rows();
        error_log("User exists check: " . $user_exists . " rows found");
        
        if ($user_exists == 0) {
            error_log("User not found in database");
            $response = array('success' => false, 'message' => 'User không tồn tại!');
            echo json_encode($response);
            return;
        }

        // Thử xóa user
        error_log("Attempting database delete for user_id: " . $user_id);
        $this->db->where('userid', $user_id);
        $result = $this->db->delete('users');

        // Debug: lấy lỗi database nếu có
        $db_error = $this->db->error();
        error_log("Delete result: " . ($result ? 'true' : 'false'));
        error_log("Database error: " . json_encode($db_error));
        
        $response = array();
        if ($result) {
            error_log("User deleted successfully");
            $response['success'] = true;
            $response['message'] = 'Xóa thành công!';
        } else {
            error_log("Failed to delete user");
            $response['success'] = false;
            $response['message'] = 'Có lỗi xảy ra khi xóa!';
            if ($db_error['code'] != 0) {
                $response['debug'] = $db_error['message'];
                error_log("Database error message: " . $db_error['message']);
            }
        }

        error_log("Sending response: " . json_encode($response));
        echo json_encode($response);
    }

    // Quản lý sản phẩm
    public function admin_products() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            redirect('login');
        }

        // Lấy thống kê sản phẩm từ database
        $stats = array();
        
        // Tổng số sản phẩm
        $this->db->where('post_type', 'product');
        $stats['total_products'] = $this->db->count_all_results('posts');
        
        // Sản phẩm đã publish
        $this->db->where('post_type', 'product');
        $this->db->where('status', 'publish');
        $stats['published_products'] = $this->db->count_all_results('posts');
        
        // Sản phẩm draft
        $this->db->where('post_type', 'product');
        $this->db->where('status', 'draft');
        $stats['draft_products'] = $this->db->count_all_results('posts');
        
        // Sản phẩm mới (7 ngày gần đây)
        $this->db->where('post_type', 'product');
        $this->db->where('addtime >=', time() - (7 * 24 * 60 * 60));
        $stats['new_products'] = $this->db->count_all_results('posts');

        // Lấy danh sách tất cả sản phẩm từ database
        $this->db->select('id, title, brand, type, post_type, status, addtime, image as featured_image, description, price');
        $this->db->where('post_type', 'product');
        $this->db->order_by('addtime', 'DESC');
        $products = $this->db->get('posts')->result();

        $data = array(
            'title' => 'Quản lý Sản phẩm - Admin Dashboard',
            'user' => $logged_in,
            'stats' => $stats,
            'products' => $products
        );

        $this->load->view('admin/admin_products', $data);
    }

    // Xem chi tiết sản phẩm
    public function view_product() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $product_id = $this->input->post('product_id');
        
        if (!$product_id) {
            $response = array('success' => false, 'message' => 'ID sản phẩm không hợp lệ!');
            echo json_encode($response);
            return;
        }

        // Lấy thông tin sản phẩm
        $this->db->select('id, title, brand, type, post_type, status, addtime, image, description, price');
        $this->db->where('id', $product_id);
        $this->db->where('post_type', 'product');
        $product = $this->db->get('posts')->row();

        if (!$product) {
            $response = array('success' => false, 'message' => 'Sản phẩm không tồn tại!');
            echo json_encode($response);
            return;
        }

        // Tạo HTML cho modal body (không bao gồm header và footer)
        $html = '
            <div class="row">
                <div class="col-md-4">
                    <img src="' . $product->image . '" class="img-fluid rounded" alt="' . $product->title . '">
                </div>
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>' . $product->id . '</td>
                        </tr>
                        <tr>
                            <td><strong>Tên sản phẩm:</strong></td>
                            <td>' . $product->title . '</td>
                        </tr>
                        <tr>
                            <td><strong>Thương hiệu:</strong></td>
                            <td>' . ($product->brand ?: 'Chưa có') . '</td>
                        </tr>
                        <tr>
                            <td><strong>Loại xe:</strong></td>
                            <td>' . ($product->type ?: 'Chưa có') . '</td>
                        </tr>
                        <tr>
                            <td><strong>Mô tả:</strong></td>
                            <td>' . ($product->description ?: 'Chưa có') . '</td>
                        </tr>
                        <tr>
                            <td><strong>Giá:</strong></td>
                            <td>' . ($product->price ?: 'Chưa có') . '</td>
                        </tr>
                        <tr>
                            <td><strong>Loại:</strong></td>
                            <td>Sản phẩm</td>
                        </tr>
                        <tr>
                            <td><strong>Trạng thái:</strong></td>
                            <td><span class="badge bg-' . ($product->status == 'publish' ? 'success' : 'warning') . '">' . ($product->status == 'publish' ? 'Đã Publish' : 'Draft') . '</span></td>
                        </tr>
                        <tr>
                            <td><strong>Ngày tạo:</strong></td>
                            <td>' . date('d/m/Y H:i', $product->addtime) . '</td>
                        </tr>
                    </table>
                </div>
            </div>';

        $response = array('success' => true, 'html' => $html);
        echo json_encode($response);
    }

    // Chỉnh sửa sản phẩm
    public function edit_product() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $product_id = $this->input->post('product_id');
        
        if (!$product_id) {
            $response = array('success' => false, 'message' => 'ID sản phẩm không hợp lệ!');
            echo json_encode($response);
            return;
        }

        // Lấy thông tin sản phẩm
        $this->db->select('id, title, brand, type, status, image, description, price, specs, images, interior_images');
        $this->db->where('id', $product_id);
        $this->db->where('post_type', 'product');
        $product = $this->db->get('posts')->row();

        if (!$product) {
            $response = array('success' => false, 'message' => 'Sản phẩm không tồn tại!');
            echo json_encode($response);
            return;
        }

        // Parse specs JSON nếu có
        $specs_data = array();
        if (!empty($product->specs)) {
            $specs_data = json_decode($product->specs, true);
        }

        // Tạo HTML cho form chỉnh sửa (chỉ modal body)
        $html = '
                <input type="hidden" name="product_id" value="' . $product->id . '">
                <div class="mb-3">
                    <label for="edit_title" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="edit_title" name="title" value="' . htmlspecialchars($product->title) . '" required>
                </div>
                <div class="mb-3">
                    <label for="edit_brand" class="form-label">Thương hiệu</label>
                    <select class="form-select" id="edit_brand" name="brand" required>
                        <option value="">Chọn thương hiệu</option>
                        <option value="Toyota"' . ($product->brand == 'Toyota' ? ' selected' : '') . '>Toyota</option>
                        <option value="Mitsubishi"' . ($product->brand == 'Mitsubishi' ? ' selected' : '') . '>Mitsubishi</option>
                        <option value="Mazda"' . ($product->brand == 'Mazda' ? ' selected' : '') . '>Mazda</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit_type" class="form-label">Loại xe</label>
                    <select class="form-select" id="edit_type" name="type" required>
                        <option value="">Chọn loại xe</option>
                        <option value="Hatch Back"' . ($product->type == 'Hatch Back' ? ' selected' : '') . '>Hatch Back</option>
                        <option value="Sedan"' . ($product->type == 'Sedan' ? ' selected' : '') . '>Sedan</option>
                        <option value="MPV"' . ($product->type == 'MPV' ? ' selected' : '') . '>MPV</option>
                        <option value="Pick up"' . ($product->type == 'Pick up' ? ' selected' : '') . '>Pick up</option>
                        <option value="Crossover"' . ($product->type == 'Crossover' ? ' selected' : '') . '>Crossover</option>
                        <option value="SUV"' . ($product->type == 'SUV' ? ' selected' : '') . '>SUV</option>
                        <option value="Couple - xe thể thao"' . ($product->type == 'Couple - xe thể thao' ? ' selected' : '') . '>Couple - xe thể thao</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit_status" class="form-label">Trạng thái</label>
                    <select class="form-select" id="edit_status" name="status" required>
                        <option value="publish"' . ($product->status == 'publish' ? ' selected' : '') . '>Publish</option>
                        <option value="draft"' . ($product->status == 'draft' ? ' selected' : '') . '>Draft</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit_description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="edit_description" name="description" rows="3" placeholder="Nhập mô tả sản phẩm">' . htmlspecialchars($product->description) . '</textarea>
                </div>
                <div class="mb-3">
                    <label for="edit_price" class="form-label">Giá</label>
                    <input type="text" class="form-control" id="edit_price" name="price" value="' . htmlspecialchars($product->price) . '" placeholder="Nhập giá sản phẩm">
                </div>
                <div class="mb-3">
                    <label class="form-label">Hình ảnh sản phẩm</label>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="edit_image" class="form-label">Đường dẫn hình ảnh</label>
                            <input type="text" class="form-control" id="edit_image" name="image" value="' . htmlspecialchars($product->image) . '" placeholder="Nhập đường dẫn hình ảnh">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_image_file" class="form-label">Hoặc upload file mới</label>
                            <input type="file" class="form-control" id="edit_image_file" name="image_file" accept="image/*">
                            <small class="form-text text-muted">Chọn file JPG, PNG, GIF, WEBP (tối đa 2MB) - Lưu vào assets/img</small>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="form-label">Hình ảnh hiện tại:</label>
                        <div class="border rounded p-2">
                            <img src="' . $product->image . '" class="img-thumbnail" style="max-height: 100px;" alt="Current Image">
                        </div>
                    </div>
                </div>
                
                <!-- Hình ảnh ngoại thất (images) -->
                <div class="mb-3">
                    <h6 class="form-label fw-bold text-info">Hình ảnh ngoại thất (cho Tổng quan & Ngoại thất)</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="edit_images_text" class="form-label">Đường dẫn hình ảnh (JSON)</label>
                            <textarea class="form-control" id="edit_images_text" name="images_text" rows="3" placeholder=\'["/kholanh/assets/img/toyota-avanza.webp", "/kholanh/assets/img/corolla.webp"]\'>' . htmlspecialchars($product->images) . '</textarea>
                            <small class="form-text text-muted">Nhập mảng JSON các đường dẫn hình ảnh</small>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_images_files" class="form-label">Hoặc upload nhiều file</label>
                            <input type="file" class="form-control" id="edit_images_files" name="images_files[]" accept="image/*" multiple>
                            <small class="form-text text-muted">Chọn nhiều file JPG, PNG, GIF, WEBP</small>
                        </div>
                    </div>
                </div>
                
                <!-- Hình ảnh nội thất (interior_images) -->
                <div class="mb-3">
                    <h6 class="form-label fw-bold text-warning">Hình ảnh nội thất</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="edit_interior_images_text" class="form-label">Đường dẫn hình ảnh (JSON)</label>
                            <textarea class="form-control" id="edit_interior_images_text" name="interior_images_text" rows="3" placeholder=\'["/kholanh/assets/img/noi-that-1.webp", "/kholanh/assets/img/noi-that-2.webp"]\'>' . htmlspecialchars($product->interior_images) . '</textarea>
                            <small class="form-text text-muted">Nhập mảng JSON các đường dẫn hình ảnh nội thất</small>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_interior_images_files" class="form-label">Hoặc upload nhiều file</label>
                            <input type="file" class="form-control" id="edit_interior_images_files" name="interior_images_files[]" accept="image/*" multiple>
                            <small class="form-text text-muted">Chọn nhiều file JPG, PNG, GIF, WEBP</small>
                        </div>
                    </div>
                </div>
                
                <!-- Thông số kỹ thuật -->
                <div class="mb-3">
                    <h6 class="form-label fw-bold text-primary">Thông số kỹ thuật</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="edit_kich_thuoc" class="form-label">Kích thước</label>
                            <input type="text" class="form-control specs-input" id="edit_kich_thuoc" name="kich_thuoc" value="' . (isset($specs_data['Kích thước']) ? htmlspecialchars($specs_data['Kích thước']) : '') . '" placeholder="Ví dụ: 4.640 x 1.775 x 1.460 mm">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_dong_co" class="form-label">Động cơ</label>
                            <input type="text" class="form-control specs-input" id="edit_dong_co" name="dong_co" value="' . (isset($specs_data['Động cơ']) ? htmlspecialchars($specs_data['Động cơ']) : '') . '" placeholder="Ví dụ: 1.8L I4">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="edit_cong_suat" class="form-label">Công suất</label>
                            <input type="text" class="form-control specs-input" id="edit_cong_suat" name="cong_suat" value="' . (isset($specs_data['Công suất']) ? htmlspecialchars($specs_data['Công suất']) : '') . '" placeholder="Ví dụ: 138 mã lực">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_hop_so" class="form-label">Hộp số</label>
                            <input type="text" class="form-control specs-input" id="edit_hop_so" name="hop_so" value="' . (isset($specs_data['Hộp số']) ? htmlspecialchars($specs_data['Hộp số']) : '') . '" placeholder="Ví dụ: CVT">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="edit_dung_tich_binh_xang" class="form-label">Dung tích bình xăng</label>
                            <input type="text" class="form-control specs-input" id="edit_dung_tich_binh_xang" name="dung_tich_binh_xang" value="' . (isset($specs_data['Dung tích bình xăng']) ? htmlspecialchars($specs_data['Dung tích bình xăng']) : '') . '" placeholder="Ví dụ: 50L">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_so_cho_ngoi" class="form-label">Số chỗ ngồi</label>
                            <input type="text" class="form-control specs-input" id="edit_so_cho_ngoi" name="so_cho_ngoi" value="' . (isset($specs_data['Số chỗ ngồi']) ? htmlspecialchars($specs_data['Số chỗ ngồi']) : '') . '" placeholder="Ví dụ: 5">
                        </div>
                    </div>
                </div>
                
                <!-- Dự tính chi phí theo tỉnh thành -->
                <div class="mb-3">
                    <h6 class="form-label fw-bold text-success">Dự tính chi phí theo tỉnh thành</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="text-center text-primary">TP. Hồ Chí Minh</h6>
                            <div class="mb-2">
                                <label for="edit_phi_dang_ky_hcm" class="form-label">Phí đăng ký</label>
                                <input type="number" class="form-control specs-input" id="edit_phi_dang_ky_hcm" name="phi_dang_ky_hcm" value="' . (isset($specs_data['Phí đăng ký HCM']) ? $specs_data['Phí đăng ký HCM'] : '') . '" placeholder="0">
                            </div>
                            <div class="mb-2">
                                <label for="edit_phi_bao_hiem_hcm" class="form-label">Phí bảo hiểm</label>
                                <input type="number" class="form-control specs-input" id="edit_phi_bao_hiem_hcm" name="phi_bao_hiem_hcm" value="' . (isset($specs_data['Phí bảo hiểm HCM']) ? $specs_data['Phí bảo hiểm HCM'] : '') . '" placeholder="0">
                            </div>
                            <div class="mb-2">
                                <label for="edit_gia_dam_phan_hcm" class="form-label">Giá đàm phán</label>
                                <input type="number" class="form-control specs-input" id="edit_gia_dam_phan_hcm" name="gia_dam_phan_hcm" value="' . (isset($specs_data['Giá đàm phán HCM']) ? $specs_data['Giá đàm phán HCM'] : '') . '" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-center text-primary">Hà Nội</h6>
                            <div class="mb-2">
                                <label for="edit_phi_dang_ky_hn" class="form-label">Phí đăng ký</label>
                                <input type="number" class="form-control specs-input" id="edit_phi_dang_ky_hn" name="phi_dang_ky_hn" value="' . (isset($specs_data['Phí đăng ký HN']) ? $specs_data['Phí đăng ký HN'] : '') . '" placeholder="0">
                            </div>
                            <div class="mb-2">
                                <label for="edit_phi_bao_hiem_hn" class="form-label">Phí bảo hiểm</label>
                                <input type="number" class="form-control specs-input" id="edit_phi_bao_hiem_hn" name="phi_bao_hiem_hn" value="' . (isset($specs_data['Phí bảo hiểm HN']) ? $specs_data['Phí bảo hiểm HN'] : '') . '" placeholder="0">
                            </div>
                            <div class="mb-2">
                                <label for="edit_gia_dam_phan_hn" class="form-label">Giá đàm phán</label>
                                <input type="number" class="form-control specs-input" id="edit_gia_dam_phan_hn" name="gia_dam_phan_hn" value="' . (isset($specs_data['Giá đàm phán HN']) ? $specs_data['Giá đàm phán HN'] : '') . '" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-center text-primary">Đà Nẵng</h6>
                            <div class="mb-2">
                                <label for="edit_phi_dang_ky_dn" class="form-label">Phí đăng ký</label>
                                <input type="number" class="form-control specs-input" id="edit_phi_dang_ky_dn" name="phi_dang_ky_dn" value="' . (isset($specs_data['Phí đăng ký DN']) ? $specs_data['Phí đăng ký DN'] : '') . '" placeholder="0">
                            </div>
                            <div class="mb-2">
                                <label for="edit_phi_bao_hiem_dn" class="form-label">Phí bảo hiểm</label>
                                <input type="number" class="form-control specs-input" id="edit_phi_bao_hiem_dn" name="phi_bao_hiem_dn" value="' . (isset($specs_data['Phí bảo hiểm DN']) ? $specs_data['Phí bảo hiểm DN'] : '') . '" placeholder="0">
                            </div>
                            <div class="mb-2">
                                <label for="edit_gia_dam_phan_dn" class="form-label">Giá đàm phán</label>
                                <input type="number" class="form-control specs-input" id="edit_gia_dam_phan_dn" name="gia_dam_phan_dn" value="' . (isset($specs_data['Giá đàm phán DN']) ? $specs_data['Giá đàm phán DN'] : '') . '" placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Hidden inputs for JSON data -->
                <input type="hidden" id="edit_specs" name="specs">
                <input type="hidden" id="edit_images" name="images">
                <input type="hidden" id="edit_interior_images" name="interior_images">';

        $response = array('success' => true, 'html' => $html);
        echo json_encode($response);
    }

    // Cập nhật sản phẩm
    public function update_product() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $product_id = $this->input->post('product_id');
        $title = $this->input->post('title');
        $brand = $this->input->post('brand');
        $type = $this->input->post('type');
        $status = $this->input->post('status');
        $description = $this->input->post('description');
        $price = $this->input->post('price');
        $image = $this->input->post('image');
        $specs = $this->input->post('specs');
        $images = $this->input->post('images') ?: '[]';
        $interior_images = $this->input->post('interior_images') ?: '[]';

        // Validation
        if (!$product_id || !$title || !$brand || !$type || !$status) {
            $response = array('success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin bắt buộc!');
            echo json_encode($response);
            return;
        }

        // Kiểm tra sản phẩm có tồn tại không
        $product_exists = $this->db->where('id', $product_id)
                                  ->where('post_type', 'product')
                                  ->get('posts')->num_rows();
        
        if ($product_exists == 0) {
            $response = array('success' => false, 'message' => 'Sản phẩm không tồn tại!');
            echo json_encode($response);
            return;
        }

        // Xử lý upload hình ảnh nếu có
        $uploaded_image = $this->upload_image();
        if ($uploaded_image !== false) {
            $image = $uploaded_image; // Sử dụng hình ảnh mới upload
        }
        
        // Xử lý upload nhiều hình ảnh ngoại thất và nội thất
        $uploaded_exterior_images = $this->upload_multiple_images('images_files');
        $uploaded_interior_images = $this->upload_multiple_images('interior_images_files');
        
        // Nếu có upload file, thêm vào danh sách
        if (!empty($uploaded_exterior_images)) {
            $existing_images = json_decode($images, true) ?: array();
            $all_images = array_merge($existing_images, $uploaded_exterior_images);
            $images = json_encode($all_images);
        }
        
        if (!empty($uploaded_interior_images)) {
            $existing_interior_images = json_decode($interior_images, true) ?: array();
            $all_interior_images = array_merge($existing_interior_images, $uploaded_interior_images);
            $interior_images = json_encode($all_interior_images);
        }

        // Cập nhật sản phẩm
        $update_data = array(
            'title' => $title,
            'brand' => $brand,
            'type' => $type,
            'status' => $status,
            'description' => $description,
            'price' => $price,
            'image' => $image,
            'images' => $images,
            'interior_images' => $interior_images,
            'specs' => $specs
        );

        $this->db->where('id', $product_id);
        $result = $this->db->update('posts', $update_data);

        if ($result) {
            // Cập nhật dữ liệu trong bảng postmeta
            $postmeta_updates = array(
                array(
                    'meta_key' => 'homeimgfile',
                    'meta_value' => $image
                ),
                array(
                    'meta_key' => 'homeimgalt',
                    'meta_value' => $title
                )
            );
            
            foreach ($postmeta_updates as $update) {
                $this->db->where('post_id', $product_id);
                $this->db->where('meta_key', $update['meta_key']);
                $exists = $this->db->get('postmeta')->num_rows();
                
                if ($exists > 0) {
                    // Cập nhật nếu đã tồn tại
                    $this->db->where('post_id', $product_id);
                    $this->db->where('meta_key', $update['meta_key']);
                    $this->db->update('postmeta', array('meta_value' => $update['meta_value']));
                } else {
                    // Thêm mới nếu chưa tồn tại
                    $this->db->insert('postmeta', array(
                        'post_id' => $product_id,
                        'meta_key' => $update['meta_key'],
                        'meta_value' => $update['meta_value']
                    ));
                }
            }
            
            $response = array('success' => true, 'message' => 'Cập nhật thành công!');
        } else {
            $response = array('success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật!');
        }

        echo json_encode($response);
    }

    // Upload hình ảnh
    private function upload_image() {
        // Kiểm tra có file upload không
        if (!isset($_FILES['image_file']) || $_FILES['image_file']['error'] == UPLOAD_ERR_NO_FILE) {
            return false; // Không có file upload
        }

        $file = $_FILES['image_file'];
        
        // Kiểm tra lỗi upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Kiểm tra kích thước file (tối đa 2MB)
        if ($file['size'] > 2 * 1024 * 1024) {
            return false;
        }

        // Kiểm tra loại file
        $allowed_types = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp');
        if (!in_array($file['type'], $allowed_types)) {
            return false;
        }

        // Sử dụng thư mục assets/img
        $upload_path = './assets/img/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        
        // Kiểm tra quyền ghi
        if (!is_writable($upload_path)) {
            chmod($upload_path, 0777);
        }

        // Tạo tên file unique
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_name = 'product_' . time() . '_' . rand(1000, 9999) . '.' . $file_extension;
        $file_path = $upload_path . $file_name;

        // Upload file
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            return '/kholanh/assets/img/' . $file_name;
        }

        return false;
    }

    // Thêm sản phẩm mới
    public function add_product() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $title = $this->input->post('title');
        $brand = $this->input->post('brand');
        $type = $this->input->post('type');
        $status = $this->input->post('status');
        $description = $this->input->post('description');
        $price = $this->input->post('price');
        $image = $this->input->post('image');
        $specs = $this->input->post('specs');

        // Validation
        if (!$title || !$brand || !$type || !$status) {
            $response = array('success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin bắt buộc!');
            echo json_encode($response);
            return;
        }

        // Xử lý upload hình ảnh nếu có
        $uploaded_image = $this->upload_image();
        if ($uploaded_image !== false) {
            $image = $uploaded_image; // Sử dụng hình ảnh mới upload
        } else {
            // Nếu không upload file, sử dụng đường dẫn từ input (có thể rỗng)
            $image = $this->input->post('image') ?: '';
        }

        // Xử lý upload nhiều hình ảnh ngoại thất
        $uploaded_exterior_images = $this->upload_multiple_images('images_files');
        $uploaded_interior_images = $this->upload_multiple_images('interior_images_files');
        
        // Lấy dữ liệu images và interior_images
        $images = $this->input->post('images') ?: '[]';
        $interior_images = $this->input->post('interior_images') ?: '[]';
        
        // Nếu có upload file, thêm vào danh sách
        if (!empty($uploaded_exterior_images)) {
            $existing_images = json_decode($images, true) ?: array();
            $all_images = array_merge($existing_images, $uploaded_exterior_images);
            $images = json_encode($all_images);
        }
        
        if (!empty($uploaded_interior_images)) {
            $existing_interior_images = json_decode($interior_images, true) ?: array();
            $all_interior_images = array_merge($existing_interior_images, $uploaded_interior_images);
            $interior_images = json_encode($all_interior_images);
        }

        // Thêm sản phẩm mới vào bảng posts
        $insert_data = array(
            'title' => $title,
            'post_type' => 'product',
            'brand' => $brand,
            'type' => $type,
            'status' => $status,
            'description' => $description,
            'price' => $price,
            'image' => $image,
            'images' => $images,
            'interior_images' => $interior_images,
            'specs' => $specs,
            'addtime' => time()
        );

        $result = $this->db->insert('posts', $insert_data);
        
        if ($result) {
            $post_id = $this->db->insert_id();
            
            // Thêm dữ liệu vào bảng postmeta để đảm bảo tìm kiếm hoạt động
            $postmeta_data = array(
                array(
                    'post_id' => $post_id,
                    'meta_key' => 'homeimgfile',
                    'meta_value' => $image
                ),
                array(
                    'post_id' => $post_id,
                    'meta_key' => 'homeimgalt',
                    'meta_value' => $title
                ),
                array(
                    'post_id' => $post_id,
                    'meta_key' => 'post_cat_id',
                    'meta_value' => '1' // Mặc định category ID = 1
                )
            );
            
            $this->db->insert_batch('postmeta', $postmeta_data);
            
            $response = array('success' => true, 'message' => 'Thêm sản phẩm thành công!');
        } else {
            $response = array('success' => false, 'message' => 'Có lỗi xảy ra khi thêm sản phẩm!');
        }

        echo json_encode($response);
    }

    // Xóa sản phẩm
    public function delete_product() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $product_id = $this->input->post('product_id');
        
        if (!$product_id) {
            $response = array('success' => false, 'message' => 'ID sản phẩm không hợp lệ!');
            echo json_encode($response);
            return;
        }

        // Kiểm tra sản phẩm có tồn tại không
        $product_exists = $this->db->where('id', $product_id)
                                  ->where('post_type', 'product')
                                  ->get('posts')->num_rows();
        
        if ($product_exists == 0) {
            $response = array('success' => false, 'message' => 'Sản phẩm không tồn tại!');
            echo json_encode($response);
            return;
        }

        // Xóa sản phẩm
        $this->db->where('id', $product_id);
        $result = $this->db->delete('posts');

        if ($result) {
            $response = array('success' => true, 'message' => 'Xóa thành công!');
        } else {
            $response = array('success' => false, 'message' => 'Có lỗi xảy ra khi xóa!');
        }

        echo json_encode($response);
    }

    // Quản lý tin tức
    public function admin_news() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            redirect('login');
        }

        // Lấy thống kê tin tức từ database
        $stats = array();
        
        // Tổng số tin tức
        $this->db->where('post_type', 'banner');
        $this->db->where('is_news', 1);
        $stats['total_news'] = $this->db->count_all_results('posts');
        
        // Tin tức đã publish
        $this->db->where('post_type', 'banner');
        $this->db->where('is_news', 1);
        $this->db->where('status', 'publish');
        $stats['published_news'] = $this->db->count_all_results('posts');
        
        // Tin tức draft
        $this->db->where('post_type', 'banner');
        $this->db->where('is_news', 1);
        $this->db->where('status', 'draft');
        $stats['draft_news'] = $this->db->count_all_results('posts');
        
        // Tin tức mới (7 ngày gần đây)
        $this->db->where('post_type', 'banner');
        $this->db->where('is_news', 1);
        $this->db->where('addtime >=', time() - (7 * 24 * 60 * 60));
        $stats['new_news'] = $this->db->count_all_results('posts');

        // Lấy danh sách tất cả tin tức từ database
        $this->db->select('id, title, post_type, status, addtime, image as featured_image, description');
        $this->db->where('post_type', 'banner');
        $this->db->where('is_news', 1);
        $this->db->order_by('addtime', 'DESC');
        $news = $this->db->get('posts')->result();

        $data = array(
            'title' => 'Quản lý Tin tức - Admin Dashboard',
            'user' => $logged_in,
            'stats' => $stats,
            'news' => $news
        );

        $this->load->view('admin/admin_news', $data);
    }

    // Xem chi tiết tin tức
    public function view_news() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $news_id = $this->input->post('news_id');
        
        if (!$news_id) {
            $response = array('success' => false, 'message' => 'ID tin tức không hợp lệ!');
            echo json_encode($response);
            return;
        }

        // Lấy thông tin tin tức
        $this->db->select('id, title, post_type, status, addtime, image, description');
        $this->db->where('id', $news_id);
        $this->db->where('post_type', 'banner');
        $this->db->where('is_news', 1);
        $news = $this->db->get('posts')->row();

        if (!$news) {
            $response = array('success' => false, 'message' => 'Tin tức không tồn tại!');
            echo json_encode($response);
            return;
        }

        // Tạo HTML cho modal body
        $html = '
            <div class="row">
                <div class="col-md-4">
                    <img src="' . $news->image . '" class="img-fluid rounded" alt="' . $news->title . '">
                </div>
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>' . $news->id . '</td>
                        </tr>
                        <tr>
                            <td><strong>Tiêu đề:</strong></td>
                            <td>' . $news->title . '</td>
                        </tr>
                        <tr>
                            <td><strong>Mô tả:</strong></td>
                            <td>' . ($news->description ?: 'Chưa có') . '</td>
                        </tr>
                        <tr>
                            <td><strong>Loại:</strong></td>
                            <td>Tin tức</td>
                        </tr>
                        <tr>
                            <td><strong>Trạng thái:</strong></td>
                            <td><span class="badge bg-' . ($news->status == 'publish' ? 'success' : 'warning') . '">' . ($news->status == 'publish' ? 'Đã Publish' : 'Draft') . '</span></td>
                        </tr>
                        <tr>
                            <td><strong>Ngày tạo:</strong></td>
                            <td>' . date('d/m/Y H:i', $news->addtime) . '</td>
                        </tr>
                    </table>
                </div>
            </div>';

        $response = array('success' => true, 'html' => $html);
        echo json_encode($response);
    }

    // Chỉnh sửa tin tức
    public function edit_news() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $news_id = $this->input->post('news_id');
        
        if (!$news_id) {
            $response = array('success' => false, 'message' => 'ID tin tức không hợp lệ!');
            echo json_encode($response);
            return;
        }

        // Lấy thông tin tin tức
        $this->db->select('id, title, status, image, description');
        $this->db->where('id', $news_id);
        $this->db->where('post_type', 'banner');
        $this->db->where('is_news', 1);
        $news = $this->db->get('posts')->row();

        if (!$news) {
            $response = array('success' => false, 'message' => 'Tin tức không tồn tại!');
            echo json_encode($response);
            return;
        }

        // Tạo HTML cho form chỉnh sửa
        $html = '
                <input type="hidden" name="news_id" value="' . $news->id . '">
                <div class="mb-3">
                    <label for="edit_title" class="form-label">Tiêu đề tin tức</label>
                    <input type="text" class="form-control" id="edit_title" name="title" value="' . htmlspecialchars($news->title) . '" required>
                </div>

                <div class="mb-3">
                    <label for="edit_description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="edit_description" name="description" rows="3" placeholder="Nhập mô tả tin tức">' . htmlspecialchars($news->description) . '</textarea>
                </div>

                <div class="mb-3">
                    <label for="edit_status" class="form-label">Trạng thái</label>
                    <select class="form-select" id="edit_status" name="status" required>
                        <option value="publish"' . ($news->status == 'publish' ? ' selected' : '') . '>Publish</option>
                        <option value="draft"' . ($news->status == 'draft' ? ' selected' : '') . '>Draft</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hình ảnh tin tức</label>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="edit_image" class="form-label">Đường dẫn hình ảnh</label>
                            <input type="text" class="form-control" id="edit_image" name="image" value="' . htmlspecialchars($news->image) . '" placeholder="Nhập đường dẫn hình ảnh">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_image_file" class="form-label">Hoặc upload file mới</label>
                            <input type="file" class="form-control" id="edit_image_file" name="image_file" accept="image/*">
                            <small class="form-text text-muted">Chọn file JPG, PNG, GIF, WEBP (tối đa 2MB) - Lưu vào assets/img</small>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="form-label">Hình ảnh hiện tại:</label>
                        <div class="border rounded p-2">
                            <img src="' . $news->image . '" class="img-thumbnail" style="max-height: 100px;" alt="Current Image">
                        </div>
                    </div>
                </div>';

        $response = array('success' => true, 'html' => $html);
        echo json_encode($response);
    }

    // Cập nhật tin tức
    public function update_news() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $news_id = $this->input->post('news_id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $image = $this->input->post('image');

        // Validation
        if (!$news_id || !$title || !$status) {
            $response = array('success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin bắt buộc!');
            echo json_encode($response);
            return;
        }

        // Kiểm tra tin tức có tồn tại không
        $news_exists = $this->db->where('id', $news_id)
                               ->where('post_type', 'banner')
                               ->where('is_news', 1)
                               ->get('posts')->num_rows();
        
        if ($news_exists == 0) {
            $response = array('success' => false, 'message' => 'Tin tức không tồn tại!');
            echo json_encode($response);
            return;
        }

        // Xử lý upload hình ảnh nếu có
        $uploaded_image = $this->upload_image();
        if ($uploaded_image !== false) {
            $image = $uploaded_image;
        }

        // Cập nhật tin tức
        $update_data = array(
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'image' => $image
        );

        $this->db->where('id', $news_id);
        $result = $this->db->update('posts', $update_data);

        if ($result) {
            $response = array('success' => true, 'message' => 'Cập nhật thành công!');
        } else {
            $response = array('success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật!');
        }

        echo json_encode($response);
    }

    // Thêm tin tức mới
    public function add_news() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $image = $this->input->post('image');

        // Validation
        if (!$title || !$status) {
            $response = array('success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin bắt buộc!');
            echo json_encode($response);
            return;
        }

        // Xử lý upload hình ảnh nếu có
        $uploaded_image = $this->upload_image();
        if ($uploaded_image !== false) {
            $image = $uploaded_image;
        } else {
            // Nếu không upload file, sử dụng đường dẫn từ input (có thể rỗng)
            $image = $this->input->post('image') ?: '';
        }

        // Thêm tin tức mới
        $insert_data = array(
            'title' => $title,
            'description' => $description,
            'post_type' => 'banner',
            'is_news' => 1,
            'status' => $status,
            'image' => $image,
            'addtime' => time()
        );

        $result = $this->db->insert('posts', $insert_data);

        if ($result) {
            $response = array('success' => true, 'message' => 'Thêm tin tức thành công!');
        } else {
            $response = array('success' => false, 'message' => 'Có lỗi xảy ra khi thêm tin tức!');
        }

        echo json_encode($response);
    }

    // Xóa tin tức
    public function delete_news() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            $response = array('success' => false, 'message' => 'Vui lòng đăng nhập!');
            echo json_encode($response);
            return;
        }

        $logged_in = $this->session->userdata('logged_in');
        
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            $response = array('success' => false, 'message' => 'Không có quyền truy cập!');
            echo json_encode($response);
            return;
        }

        $news_id = $this->input->post('news_id');
        
        if (!$news_id) {
            $response = array('success' => false, 'message' => 'ID tin tức không hợp lệ!');
            echo json_encode($response);
            return;
        }

        // Kiểm tra tin tức có tồn tại không
        $news_exists = $this->db->where('id', $news_id)
                               ->where('post_type', 'banner')
                               ->where('is_news', 1)
                               ->get('posts')->num_rows();
        
        if ($news_exists == 0) {
            $response = array('success' => false, 'message' => 'Tin tức không tồn tại!');
            echo json_encode($response);
            return;
        }

        // Xóa tin tức
        $this->db->where('id', $news_id);
        $this->db->where('post_type', 'banner');
        $this->db->where('is_news', 1);
        $result = $this->db->delete('posts');

        if ($result) {
            $response = array('success' => true, 'message' => 'Xóa tin tức thành công!');
        } else {
            $response = array('success' => false, 'message' => 'Có lỗi xảy ra khi xóa tin tức!');
        }

        echo json_encode($response);
    }

    // Upload nhiều hình ảnh
    private function upload_multiple_images($field_name) {
        $uploaded_files = array();
        
        if (!isset($_FILES[$field_name]) || empty($_FILES[$field_name]['name'][0])) {
            return $uploaded_files;
        }
        
        $files = $_FILES[$field_name];
        $file_count = count($files['name']);
        
        for ($i = 0; $i < $file_count; $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $file_name = $files['name'][$i];
                $file_tmp = $files['tmp_name'][$i];
                $file_size = $files['size'][$i];
                $file_type = $files['type'][$i];
                
                // Kiểm tra loại file
                $allowed_types = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp');
                if (!in_array($file_type, $allowed_types)) {
                    continue; // Bỏ qua file không hợp lệ
                }
                
                // Kiểm tra kích thước file (giới hạn 5MB)
                if ($file_size > 5 * 1024 * 1024) {
                    continue; // Bỏ qua file quá lớn
                }
                
                // Tạo tên file mới để tránh trùng lặp
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $new_file_name = 'admin_' . time() . '_' . $i . '.' . $file_extension;
                
                // Đường dẫn upload
                $upload_path = './assets/img/';
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                
                $destination = $upload_path . $new_file_name;
                
                // Upload file
                if (move_uploaded_file($file_tmp, $destination)) {
                    $uploaded_files[] = '/kholanh/assets/img/' . $new_file_name;
                }
            }
        }
        
        return $uploaded_files;
    }

    // Quản lý sản phẩm kho
    public function admin_stock_products() {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        // Kiểm tra quyền admin
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            redirect('login');
        }
        $this->load->database();
        // Lấy danh sách sản phẩm kho
        $this->db->select('shops_rows.*, shops_cat.name as cat_name');
        $this->db->from('shops_rows');
        $this->db->join('shops_cat', 'shops_cat.id = shops_rows.listcatid', 'left');
        $this->db->order_by('shops_rows.created', 'DESC');
        $products = $this->db->get()->result();
        // Lấy danh sách danh mục
        $cats = $this->db->get('shops_cat')->result();
        $data = array(
            'title' => 'Quản lý sản phẩm kho',
            'products' => $products,
            'cats' => $cats,
            'user' => $logged_in
        );
        $this->load->view('admin/admin_stock_products', $data);
    }

    // Xem chi tiết sản phẩm kho
    public function view_stock_product() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            redirect('login');
        }

        $product_id = $this->input->post('product_id');
        $this->load->database();
        
        $this->db->select('shops_rows.*, shops_cat.name as cat_name');
        $this->db->from('shops_rows');
        $this->db->join('shops_cat', 'shops_cat.id = shops_rows.listcatid', 'left');
        $this->db->where('shops_rows.id', $product_id);
        $product = $this->db->get()->row();

        if ($product) {
            $html = '<div class="row">';
            $html .= '<div class="col-md-4">';
            if (!empty($product->homeimgfile)) {
                $html .= '<img src="' . (strpos($product->homeimgfile, '/') === 0 ? $product->homeimgfile : base_url('assets/img/' . $product->homeimgfile)) . '" class="img-fluid rounded" alt="Product">';
            } else {
                $html .= '<img src="https://via.placeholder.com/300x200" class="img-fluid rounded" alt="No Image">';
            }
            $html .= '</div>';
            $html .= '<div class="col-md-8">';
            $html .= '<h5>' . $product->title . '</h5>';
            $html .= '<table class="table table-borderless">';
            $html .= '<tr><td><strong>ID:</strong></td><td>' . $product->id . '</td></tr>';
            $html .= '<tr><td><strong>Danh mục:</strong></td><td>' . ($product->cat_name ?: 'Chưa phân loại') . '</td></tr>';
            $html .= '<tr><td><strong>Thương hiệu:</strong></td><td>' . ($product->brand ?: 'Chưa có') . '</td></tr>';
            $html .= '<tr><td><strong>Loại:</strong></td><td>' . ($product->type ?: 'Chưa có') . '</td></tr>';
            $html .= '<tr><td><strong>Ngày tạo:</strong></td><td>' . date('d/m/Y H:i', $product->created) . '</td></tr>';
            $html .= '</table>';
            $html .= '<div class="mt-3">';
            $html .= '<h6>Mô tả:</h6>';
            $html .= '<p>' . ($product->hometext ?: 'Chưa có mô tả') . '</p>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            echo json_encode(['success' => true, 'html' => $html]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
        }
    }

    // Form chỉnh sửa sản phẩm kho
    public function edit_stock_product() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            redirect('login');
        }

        $product_id = $this->input->post('product_id');
        $this->load->database();
        
        $this->db->select('shops_rows.*, shops_cat.name as cat_name');
        $this->db->from('shops_rows');
        $this->db->join('shops_cat', 'shops_cat.id = shops_rows.listcatid', 'left');
        $this->db->where('shops_rows.id', $product_id);
        $product = $this->db->get()->row();

        // Lấy danh sách danh mục
        $cats = $this->db->get('shops_cat')->result_array();

        if ($product) {
            // Parse specs JSON nếu có
            $specs_data = array();
            if (!empty($product->specs)) {
                $decoded = json_decode($product->specs, true);
                if (is_array($decoded)) {
                    $specs_data = $decoded;
                }
            }
            $html = '<input type="hidden" name="product_id" value="' . $product->id . '">';
            $html .= '<div class="mb-3">';
            $html .= '<label for="edit_title" class="form-label">Tên sản phẩm</label>';
            $html .= '<input type="text" class="form-control" id="edit_title" name="title" value="' . htmlspecialchars($product->title) . '" required>';
            $html .= '</div>';

            $html .= '<div class="mb-3">';
            $html .= '<label for="edit_cat_id" class="form-label">Danh mục</label>';
            $html .= '<select class="form-select" id="edit_cat_id" name="listcatid">';
            $html .= '<option value="">Chọn danh mục</option>';
            foreach ($cats as $cat) {
                $selected = ($cat['id'] == $product->listcatid) ? 'selected' : '';
                $html .= '<option value="' . $cat['id'] . '" ' . $selected . '>' . $cat['name'] . '</option>';
            }
            $html .= '</select>';
            $html .= '</div>';

            $html .= '<div class="row">';
            $html .= '<div class="col-md-6">';
            $html .= '<div class="mb-3">';
            $html .= '<label for="edit_brand" class="form-label">Thương hiệu</label>';
            $html .= '<select class="form-select" id="edit_brand" name="brand">';
            $html .= '<option value="">Chọn thương hiệu</option>';
            $html .= '<option value="Mitsubishi"' . ($product->brand == 'Mitsubishi' ? ' selected' : '') . '>Mitsubishi</option>';
            $html .= '<option value="Mazda"' . ($product->brand == 'Mazda' ? ' selected' : '') . '>Mazda</option>';
            $html .= '<option value="Toyota"' . ($product->brand == 'Toyota' ? ' selected' : '') . '>Toyota</option>';
            $html .= '</select>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="col-md-6">';
            $html .= '<div class="mb-3">';
            $html .= '<label for="edit_type" class="form-label">Loại</label>';
            $html .= '<select class="form-select" id="edit_type" name="type">';
            $html .= '<option value="">Chọn loại</option>';
            $html .= '<option value="SUV"' . ($product->type == 'SUV' ? ' selected' : '') . '>SUV</option>';
            $html .= '<option value="Sedan"' . ($product->type == 'Sedan' ? ' selected' : '') . '>Sedan</option>';
            $html .= '<option value="MPV"' . ($product->type == 'MPV' ? ' selected' : '') . '>MPV</option>';
            $html .= '<option value="Hatch Back"' . ($product->type == 'Hatch Back' ? ' selected' : '') . '>Hatch Back</option>';
            $html .= '</select>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="mb-3">';
            $html .= '<label for="edit_hometext" class="form-label">Mô tả</label>';
            $html .= '<textarea class="form-control" id="edit_hometext" name="hometext" rows="3">' . htmlspecialchars($product->hometext) . '</textarea>';
            $html .= '</div>';

            $html .= '<div class="mb-3">';
            $html .= '<label for="edit_image" class="form-label">Hình ảnh sản phẩm</label>';
            if (!empty($product->homeimgfile)) {
                $html .= '<div class="mb-2">';
                $html .= '<img src="' . (strpos($product->homeimgfile, '/') === 0 ? $product->homeimgfile : base_url('assets/img/' . $product->homeimgfile)) . '" class="img-thumbnail" style="max-width: 200px; max-height: 200px;" alt="Current Image">';
                $html .= '<input type="hidden" name="homeimgfile" value="' . htmlspecialchars($product->homeimgfile) . '">';
                $html .= '</div>';
            }
            $html .= '<input type="file" class="form-control" id="edit_image" name="homeimgfile" accept="image/*">';
            $html .= '<small class="form-text text-muted">Chọn file hình ảnh mới (JPG, PNG, GIF) hoặc để trống để giữ nguyên</small>';
            $html .= '</div>';

            // Exterior images (images)
            $html .= '<div class="mb-3">';
            $html .= '<h6 class="form-label fw-bold text-info">Hình ảnh ngoại thất (Tổng quan & Ngoại thất)</h6>';
            $html .= '<div class="row">';
            $html .= '<div class="col-md-6">';
            $html .= '<label for="edit_images_text" class="form-label">Đường dẫn hình ảnh (JSON)</label>';
            $html .= '<textarea class="form-control" id="edit_images_text" name="images_text" rows="3">' . htmlspecialchars($product->images) . '</textarea>';
            $html .= '<small class="form-text text-muted">Dạng: ["/kholanh/assets/img/a.webp", "/kholanh/assets/img/b.webp"]</small>';
            $html .= '</div>';
            $html .= '<div class="col-md-6">';
            $html .= '<label for="edit_images_files" class="form-label">Hoặc upload nhiều file</label>';
            $html .= '<input type="file" class="form-control" id="edit_images_files" name="images_files[]" accept="image/*" multiple>';
            $html .= '<small class="form-text text-muted">Chọn nhiều file JPG, PNG, GIF, WEBP</small>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            // Interior images
            $html .= '<div class="mb-3">';
            $html .= '<h6 class="form-label fw-bold text-warning">Hình ảnh nội thất</h6>';
            $html .= '<div class="row">';
            $html .= '<div class="col-md-6">';
            $html .= '<label for="edit_interior_images_text" class="form-label">Đường dẫn hình ảnh (JSON)</label>';
            $html .= '<textarea class="form-control" id="edit_interior_images_text" name="interior_images_text" rows="3">' . htmlspecialchars($product->interior_images) . '</textarea>';
            $html .= '<small class="form-text text-muted">Dạng: ["/kholanh/assets/img/x.webp", "/kholanh/assets/img/y.webp"]</small>';
            $html .= '</div>';
            $html .= '<div class="col-md-6">';
            $html .= '<label for="edit_interior_images_files" class="form-label">Hoặc upload nhiều file</label>';
            $html .= '<input type="file" class="form-control" id="edit_interior_images_files" name="interior_images_files[]" accept="image/*" multiple>';
            $html .= '<small class="form-text text-muted">Chọn nhiều file JPG, PNG, GIF, WEBP</small>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            // Specs inputs
            $html .= '<div class="mb-3">';
            $html .= '<h6 class="form-label fw-bold text-primary">Thông số kỹ thuật</h6>';
            $html .= '<div class="row">';
            $html .= '<div class="col-md-6"><label class="form-label">Kích thước</label><input type="text" class="form-control" id="edit_kich_thuoc" value="' . (isset($specs_data['Kích thước']) ? htmlspecialchars($specs_data['Kích thước']) : '') . '"></div>';
            $html .= '<div class="col-md-6"><label class="form-label">Động cơ</label><input type="text" class="form-control" id="edit_dong_co" value="' . (isset($specs_data['Động cơ']) ? htmlspecialchars($specs_data['Động cơ']) : '') . '"></div>';
            $html .= '</div>';
            $html .= '<div class="row mt-2">';
            $html .= '<div class="col-md-6"><label class="form-label">Công suất</label><input type="text" class="form-control" id="edit_cong_suat" value="' . (isset($specs_data['Công suất']) ? htmlspecialchars($specs_data['Công suất']) : '') . '"></div>';
            $html .= '<div class="col-md-6"><label class="form-label">Hộp số</label><input type="text" class="form-control" id="edit_hop_so" value="' . (isset($specs_data['Hộp số']) ? htmlspecialchars($specs_data['Hộp số']) : '') . '"></div>';
            $html .= '</div>';
            $html .= '<div class="row mt-2">';
            $html .= '<div class="col-md-6"><label class="form-label">Dung tích bình xăng</label><input type="text" class="form-control" id="edit_dung_tich_binh_xang" value="' . (isset($specs_data['Dung tích bình xăng']) ? htmlspecialchars($specs_data['Dung tích bình xăng']) : '') . '"></div>';
            $html .= '<div class="col-md-6"><label class="form-label">Số chỗ ngồi</label><input type="text" class="form-control" id="edit_so_cho_ngoi" value="' . (isset($specs_data['Số chỗ ngồi']) ? htmlspecialchars($specs_data['Số chỗ ngồi']) : '') . '"></div>';
            $html .= '</div>';
            $html .= '<div class="row mt-2">';
            $html .= '<div class="col-md-4"><h6 class="text-primary text-center">HCM</h6><input type="number" class="form-control mb-2" id="edit_phi_dang_ky_hcm" placeholder="Phí đăng ký" value="' . (isset($specs_data['Phí đăng ký HCM']) ? htmlspecialchars($specs_data['Phí đăng ký HCM']) : '') . '"><input type="number" class="form-control mb-2" id="edit_phi_bao_hiem_hcm" placeholder="Phí bảo hiểm" value="' . (isset($specs_data['Phí bảo hiểm HCM']) ? htmlspecialchars($specs_data['Phí bảo hiểm HCM']) : '') . '"><input type="number" class="form-control" id="edit_gia_dam_phan_hcm" placeholder="Giá đàm phán" value="' . (isset($specs_data['Giá đàm phán HCM']) ? htmlspecialchars($specs_data['Giá đàm phán HCM']) : '') . '"></div>';
            $html .= '<div class="col-md-4"><h6 class="text-primary text-center">HN</h6><input type="number" class="form-control mb-2" id="edit_phi_dang_ky_hn" placeholder="Phí đăng ký" value="' . (isset($specs_data['Phí đăng ký HN']) ? htmlspecialchars($specs_data['Phí đăng ký HN']) : '') . '"><input type="number" class="form-control mb-2" id="edit_phi_bao_hiem_hn" placeholder="Phí bảo hiểm" value="' . (isset($specs_data['Phí bảo hiểm HN']) ? htmlspecialchars($specs_data['Phí bảo hiểm HN']) : '') . '"><input type="number" class="form-control" id="edit_gia_dam_phan_hn" placeholder="Giá đàm phán" value="' . (isset($specs_data['Giá đàm phán HN']) ? htmlspecialchars($specs_data['Giá đàm phán HN']) : '') . '"></div>';
            $html .= '<div class="col-md-4"><h6 class="text-primary text-center">DN</h6><input type="number" class="form-control mb-2" id="edit_phi_dang_ky_dn" placeholder="Phí đăng ký" value="' . (isset($specs_data['Phí đăng ký DN']) ? htmlspecialchars($specs_data['Phí đăng ký DN']) : '') . '"><input type="number" class="form-control mb-2" id="edit_phi_bao_hiem_dn" placeholder="Phí bảo hiểm" value="' . (isset($specs_data['Phí bảo hiểm DN']) ? htmlspecialchars($specs_data['Phí bảo hiểm DN']) : '') . '"><input type="number" class="form-control" id="edit_gia_dam_phan_dn" placeholder="Giá đàm phán" value="' . (isset($specs_data['Giá đàm phán DN']) ? htmlspecialchars($specs_data['Giá đàm phán DN']) : '') . '"></div>';
            $html .= '</div>';

            // Hidden JSON holders
            $html .= '<input type="hidden" id="edit_specs" name="specs">';
            $html .= '<input type="hidden" id="edit_images" name="images">';
            $html .= '<input type="hidden" id="edit_interior_images" name="interior_images">';

            echo json_encode(['success' => true, 'html' => $html]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
        }
    }

    // Cập nhật sản phẩm kho
    public function update_stock_product() {
        // Simple test to see if the function is being called
        error_log('update_stock_product function called');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            redirect('login');
        }

        $this->load->database();
        
        $product_id = $this->input->post('product_id');
        
        // Xử lý upload hình ảnh nếu có
        $image_path = $this->input->post('homeimgfile'); // Giữ nguyên nếu không upload file mới
        if (isset($_FILES['homeimgfile']) && $_FILES['homeimgfile']['error'] == UPLOAD_ERR_OK) {
            $uploaded_image = $this->upload_stock_image();
            if ($uploaded_image !== false) {
                $image_path = $uploaded_image;
            }
        }
        
        // Prepare JSON data for images/interior/specs
        $images_json = $this->input->post('images') ?: '[]';
        $interior_images_json = $this->input->post('interior_images') ?: '[]';
        $specs_json = $this->input->post('specs') ?: '{}';

        // Handle multiple uploads and merge
        $uploaded_exterior_images = $this->upload_multiple_images('images_files');
        $uploaded_interior_images = $this->upload_multiple_images('interior_images_files');

        if (!empty($uploaded_exterior_images)) {
            $existing = json_decode($images_json, true) ?: array();
            $images_json = json_encode(array_merge($existing, $uploaded_exterior_images));
        }
        if (!empty($uploaded_interior_images)) {
            $existing_interior = json_decode($interior_images_json, true) ?: array();
            $interior_images_json = json_encode(array_merge($existing_interior, $uploaded_interior_images));
        }

        $data = array(
            'title' => $this->input->post('title'),
            'listcatid' => $this->input->post('listcatid') ?: null,
            'brand' => $this->input->post('brand'),
            'type' => $this->input->post('type'),
            'hometext' => $this->input->post('hometext'),
            'homeimgfile' => $image_path,
            'images' => $images_json,
            'interior_images' => $interior_images_json,
            'specs' => $specs_json,
            'modified' => time()
        );

        // Debug: Log the data being received
        error_log('Update Stock Product - Product ID: ' . $product_id);
        error_log('Update Stock Product - Data: ' . json_encode($data));

        $this->db->where('id', $product_id);
        $result = $this->db->update('shops_rows', $data);

        // Debug: Log any database errors
        if ($this->db->error()) {
            error_log('Database Error: ' . json_encode($this->db->error()));
        }

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Cập nhật sản phẩm thành công']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật: ' . $this->db->last_query()]);
        }
    }

    // Xóa sản phẩm kho
    public function delete_stock_product() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            redirect('login');
        }

        $this->load->database();
        
        $product_id = $this->input->post('product_id');
        
        $this->db->where('id', $product_id);
        $result = $this->db->delete('shops_rows');

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Xóa sản phẩm thành công']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa']);
        }
    }

    // Upload hình ảnh cho sản phẩm kho
    private function upload_stock_image() {
        // Debug: Log upload attempt
        error_log('Upload attempt - FILES: ' . json_encode($_FILES));
        
        // Kiểm tra có file upload không
        if (!isset($_FILES['homeimgfile']) || $_FILES['homeimgfile']['error'] == UPLOAD_ERR_NO_FILE) {
            error_log('No file uploaded or file error: ' . (isset($_FILES['homeimgfile']) ? $_FILES['homeimgfile']['error'] : 'no file'));
            return false; // Không có file upload
        }

        $file = $_FILES['homeimgfile'];
        
        // Kiểm tra lỗi upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            error_log('File upload error: ' . $file['error']);
            return false;
        }

        // Kiểm tra kích thước file (tối đa 2MB)
        if ($file['size'] > 2 * 1024 * 1024) {
            return false;
        }

        // Kiểm tra loại file
        $allowed_types = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp');
        if (!in_array($file['type'], $allowed_types)) {
            return false;
        }

        // Sử dụng thư mục assets/img
        $upload_path = './assets/img/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        
        // Kiểm tra quyền ghi
        if (!is_writable($upload_path)) {
            chmod($upload_path, 0777);
        }

        // Tạo tên file unique
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_name = 'stock_product_' . time() . '_' . rand(1000, 9999) . '.' . $file_extension;
        $file_path = $upload_path . $file_name;

        // Upload file
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            error_log('File uploaded successfully: ' . $file_path);
            return '/kholanh/assets/img/' . $file_name;
        }

        error_log('Failed to move uploaded file from ' . $file['tmp_name'] . ' to ' . $file_path);
        return false;
    }

    // Thêm sản phẩm kho
    public function add_stock_product() {
        // Debug: Log function call
        error_log('add_stock_product function called');
        
        // Set headers for JSON response
        header('Content-Type: application/json');
        
        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
            return;
        }
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in['role']) || $logged_in['role'] !== 'ADMIN') {
            echo json_encode(['success' => false, 'message' => 'Không có quyền truy cập']);
            return;
        }

        $this->load->database();
        
        // Debug: Log POST data
        error_log('Add Stock Product - POST data: ' . json_encode($_POST));
        error_log('Add Stock Product - FILES data: ' . json_encode($_FILES));
        
        // Xử lý upload hình ảnh nếu có
        $image_path = '';
        if (isset($_FILES['homeimgfile']) && $_FILES['homeimgfile']['error'] == UPLOAD_ERR_OK) {
            $uploaded_image = $this->upload_stock_image();
            if ($uploaded_image !== false) {
                $image_path = $uploaded_image;
            }
        }
        
        // Xử lý listcatid - nếu rỗng thì để null
        $listcatid = $this->input->post('listcatid');
        if (empty($listcatid)) {
            $listcatid = null;
        }
        // Prepare JSON data
        $images_json = $this->input->post('images') ?: '[]';
        $interior_images_json = $this->input->post('interior_images') ?: '[]';
        $specs_json = $this->input->post('specs') ?: '{}';

        // Merge uploaded multi-images if any
        $uploaded_exterior_images = $this->upload_multiple_images('images_files');
        $uploaded_interior_images = $this->upload_multiple_images('interior_images_files');

        if (!empty($uploaded_exterior_images)) {
            $existing = json_decode($images_json, true) ?: array();
            $images_json = json_encode(array_merge($existing, $uploaded_exterior_images));
        }
        if (!empty($uploaded_interior_images)) {
            $existing_interior = json_decode($interior_images_json, true) ?: array();
            $interior_images_json = json_encode(array_merge($existing_interior, $uploaded_interior_images));
        }

        $data = array(
            'title' => $this->input->post('title'),
            'listcatid' => $listcatid,
            'brand' => $this->input->post('brand'),
            'type' => $this->input->post('type'),
            'hometext' => $this->input->post('hometext'),
            'homeimgfile' => $image_path,
            'images' => $images_json,
            'interior_images' => $interior_images_json,
            'specs' => $specs_json,
            'created' => time(),
            'modified' => time()
        );

        // Debug: Log the data being inserted
        error_log('Add Stock Product - Data: ' . json_encode($data));

        $result = $this->db->insert('shops_rows', $data);
        
        // Debug: Log the result
        error_log('Add Stock Product - Insert result: ' . ($result ? 'true' : 'false'));

        // Debug: Log any database errors
        if ($this->db->error()) {
            error_log('Database Error: ' . json_encode($this->db->error()));
        }
        
        // Debug: Log the last query
        error_log('Add Stock Product - Last query: ' . $this->db->last_query());

        if ($result) {
            error_log('Add Stock Product - Sending success response');
            echo json_encode(['success' => true, 'message' => 'Thêm sản phẩm thành công']);
        } else {
            error_log('Add Stock Product - Sending error response');
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm: ' . $this->db->last_query()]);
        }
    }

    // Test function to check if AJAX is working
    public function test_update() {
        echo json_encode(['success' => true, 'message' => 'Test endpoint working']);
    }
    
    // Test function for add endpoint

} 