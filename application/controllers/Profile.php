<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        // Kiểm tra đăng nhập với session mới
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $logged_in = $this->session->userdata('logged_in');
        $user_id = $logged_in['userid'];
        
        $user = $this->Auth_model->get_user_by_id($user_id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'Không tìm thấy thông tin user!');
            redirect('login');
        }

        // Truyền data qua layout để có header/footer
        $this->load->view('layout/view_layout', array(
            'main_content' => 'profile',
            'data' => array('user' => $user),
            'title' => 'Hồ sơ cá nhân - Evo Car',
            'description' => 'Quản lý thông tin cá nhân',
            'keywords' => 'hồ sơ, cá nhân, evo car'
        ));
    }

    public function update() {
        // Kiểm tra đăng nhập với session mới
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $logged_in = $this->session->userdata('logged_in');
        $user_id = $logged_in['userid'];
        
        // Validate form
        $this->form_validation->set_rules('fullname', 'Họ và tên', 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]|max_length[15]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile');
        }

        $update_data = array(
            'full_name' => $this->input->post('fullname'),
            'phone' => $this->input->post('phone'),
            'modified' => time()
        );

        // Cập nhật thông tin
        if ($this->Auth_model->update_user($user_id, $update_data)) {
            // Cập nhật session mới
            $logged_in['full_name'] = $update_data['full_name'];
            $this->session->set_userdata('logged_in', $logged_in);
            
            $this->session->set_flashdata('success', 'Cập nhật thông tin thành công!');
        } else {
            $this->session->set_flashdata('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        
        redirect('profile');
    }

    public function change_password() {
        // Kiểm tra đăng nhập với session mới
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $logged_in = $this->session->userdata('logged_in');
        $user_id = $logged_in['userid'];
        
        // Validate form
        $this->form_validation->set_rules('current_password', 'Mật khẩu hiện tại', 'required');
        $this->form_validation->set_rules('new_password', 'Mật khẩu mới', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Xác nhận mật khẩu', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile');
        }

        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');

        // Kiểm tra mật khẩu hiện tại
        $user = $this->Auth_model->get_user_by_id($user_id);
        if (!password_verify($current_password, $user->password)) {
            $this->session->set_flashdata('error', 'Mật khẩu hiện tại không đúng!');
            redirect('profile');
        }

        // Thay đổi mật khẩu
        if ($this->Auth_model->change_password($user_id, $new_password)) {
            $this->session->set_flashdata('success', 'Thay đổi mật khẩu thành công!');
        } else {
            $this->session->set_flashdata('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        
        redirect('profile');
    }
} 