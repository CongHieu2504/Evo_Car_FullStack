<?php
class ResetPassword extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Auth_model');
    }
    public function index() {
        $token = $this->input->get('token');
        if (!$token) {
            show_error('Token không hợp lệ!', 400);
        }
        $user = $this->db->where('reset_token', $token)
                         ->where('reset_token_expire >=', time())
                         ->get('users')->row();
        if (!$user) {
            show_error('Token không hợp lệ hoặc đã hết hạn!', 400);
        }
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('password', 'Mật khẩu mới', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Xác nhận mật khẩu', 'required|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('reset_password', ['token' => $token]);
                return;
            }
            $new_password = $this->input->post('password');
            $this->Auth_model->change_password($user->userid, $new_password);
            // Xóa token sau khi đổi mật khẩu
            $this->db->where('userid', $user->userid)->update('users', ['reset_token' => null, 'reset_token_expire' => null]);
            $this->session->set_flashdata('success', 'Đặt lại mật khẩu thành công! Bạn có thể đăng nhập.');
            redirect('login');
        }
        $this->load->view('reset_password', ['token' => $token]);
    }
} 