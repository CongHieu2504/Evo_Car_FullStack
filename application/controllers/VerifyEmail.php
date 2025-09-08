<?php
class VerifyEmail extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function index() {
        $token = $this->input->get('token');
        if (!$token) {
            show_error('Token không hợp lệ!', 400);
        }
        // Tìm user theo activation_key
        $user = $this->db->where('activation_key', $token)->get('users')->row();
        if ($user && !$user->active) {
            // Kích hoạt tài khoản
            $this->db->where('userid', $user->userid)->update('users', [
                'active' => 1,
                'activation_key' => null
            ]);
            $this->session->set_flashdata('success', 'Xác thực email thành công! Bạn có thể đăng nhập.');
            redirect('login');
        } else if ($user && $user->active) {
            $this->session->set_flashdata('success', 'Tài khoản đã được xác thực trước đó.');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'Token không hợp lệ hoặc đã hết hạn!');
            redirect('login');
        }
    }
} 