<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        // Nếu đã đăng nhập thì redirect về trang chủ
        if ($this->session->userdata('logged_in')) {
            redirect(base_url());
        }

        $data = array(
            'title' => 'Đăng nhập - Evo Car',
            'description' => 'Đăng nhập vào tài khoản Evo Car',
            'keywords' => 'đăng nhập, tài khoản, evo car'
        );

        $this->load->view('layout/view_layout_login', array(
            'main_content' => 'login',
            'data' => $data
        ));
    }

    public function authenticate() {
        // Validate form - cho phép cả email và username
        $this->form_validation->set_rules('email', 'Email hoặc Username', 'required');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('login');
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Kiểm tra đăng nhập
        $user = $this->Auth_model->authenticate($email, $password);

        if ($user) {
            // Tạo session - sử dụng format giống Users controller
            $sess_array = array(
                'userid' => $user->userid,
                'username' => $user->username,
                'full_name' => $user->full_name,
                'photo' => $user->photo,
                'created' => $user->created,
                'role' => $user->role,  // Lấy role từ database
                'ref' => $user->refer_key,
            );
            $this->session->set_userdata('logged_in', $sess_array);
            
            // Xử lý "Ghi nhớ đăng nhập"
            $remember = $this->input->post('remember');
            if ($remember) {
                // Tạo cookie để ghi nhớ đăng nhập (30 ngày)
                $cookie_data = array(
                    'name'   => 'remember_login',
                    'value'  => $user->userid . '|' . md5($user->username . 'remember_key'),
                    'expire' => '2592000', // 30 ngày
                    'path'   => '/'
                );
                $this->input->set_cookie($cookie_data);
                
                // Cập nhật database
                $this->Auth_model->update_user($user->userid, array('remember' => 1));
            }
            
            $this->session->set_userdata('just_logged_in', true);
            redirect(base_url());
        } else {
            $this->session->set_flashdata('error', 'Email hoặc mật khẩu không đúng!');
            redirect('login');
        }
    }

    public function logout() {
        // Xóa cookie "Ghi nhớ đăng nhập"
        $this->input->set_cookie(array(
            'name'   => 'remember_login',
            'value'  => '',
            'expire' => '-3600',
            'path'   => '/'
        ));
        
        // Cập nhật database
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in && isset($logged_in['userid'])) {
            $this->Auth_model->update_user($logged_in['userid'], array('remember' => 0));
        }
        
        $this->session->unset_userdata('logged_in');
        $this->session->set_flashdata('success', 'Đăng xuất thành công!');
        redirect('login');
    }
} 