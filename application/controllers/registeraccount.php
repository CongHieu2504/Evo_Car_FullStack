<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterAccount extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        // Nếu đã đăng nhập thì redirect về trang chủ
        if ($this->session->userdata('user_id')) {
            redirect(base_url());
        }

        // Xóa flashdata cũ để tránh hiển thị thông báo cũ
        $this->session->unset_userdata('error');
        $this->session->unset_userdata('success');

        $data = array(
            'title' => 'Đăng ký tài khoản - Evo Car',
            'description' => 'Đăng ký tài khoản mới tại Evo Car',
            'keywords' => 'đăng ký, tài khoản, evo car'
        );

        $this->load->view('layout/view_layout_login', array(
            'main_content' => 'register_account',
            'data' => $data
        ));
    }

    public function create() {
        $this->form_validation->set_rules('username', 'Tên đăng nhập', 'required|min_length[4]|max_length[50]|alpha_dash|callback_check_username_unique');
        $this->form_validation->set_rules('fullname', 'Họ và tên', 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_unique');
        $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]|max_length[15]|callback_check_phone_unique');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Xác nhận mật khẩu', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Đăng ký tài khoản - Evo Car',
                'description' => 'Đăng ký tài khoản mới tại Evo Car',
                'keywords' => 'đăng ký, tài khoản, evo car'
            );
            $this->load->view('layout/view_layout_login', array(
                'main_content' => 'register_account',
                'data' => $data
            ));
            return;
        }

        // Tạo token xác thực email
        $activation_key = bin2hex(random_bytes(32));
        $user_data = array(
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'password' => $this->input->post('password'), // chỉ truyền raw password, không hash ở controller
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 1,
            'active' => 0, // chưa kích hoạt
            'activation_key' => $activation_key
        );
        // Tạo tài khoản
        $user_id = $this->Auth_model->create_user($user_data);
        if ($user_id) {
            // Gửi email xác thực bằng SMTP Gmail
            $verify_link = base_url('verify-email?token=' . $activation_key);
            $subject = 'Xác thực tài khoản Evo Car';
            $message = '<p>Chào ' . htmlspecialchars($user_data['fullname']) . ',</p>' .
                '<p>Bạn vừa đăng ký tài khoản tại Evo Car. Vui lòng nhấn vào link bên dưới để xác thực email:</p>' .
                '<p><a href="' . $verify_link . '">' . $verify_link . '</a></p>' .
                '<p>Nếu bạn không đăng ký tài khoản, vui lòng bỏ qua email này.</p>';
            // Cấu hình SMTP Gmail
            $this->load->library('email');
            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'billho250403@gmail.com',
                'smtp_pass' => 'eykdlbououjuuhsn',
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'newline'   => "\r\n"
            );
            $this->email->initialize($config);
            $this->email->from('billho250403@gmail.com', 'Evo Car');
            $this->email->to($user_data['email']);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            $this->session->set_flashdata('success', 'Đăng ký tài khoản thành công! Vui lòng kiểm tra email để xác thực tài khoản.');
            redirect(base_url('login'));
        } else {
            $this->session->set_flashdata('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            redirect('register_account');
        }
    }

    /**
     * Callback function kiểm tra số điện thoại unique
     */
    public function check_phone_unique($phone) {
        if ($this->Auth_model->phone_exists($phone)) {
            $this->form_validation->set_message('check_phone_unique', 'Số điện thoại này đã tồn tại!');
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Callback function để kiểm tra email unique
     */
    public function check_email_unique($email) {
        if ($this->Auth_model->email_exists($email)) {
            $this->form_validation->set_message('check_email_unique', 'Email này đã tồn tại!');
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Callback function kiểm tra username unique
     */
    public function check_username_unique($username) {
        if ($this->Auth_model->username_exists($username)) {
            $this->form_validation->set_message('check_username_unique', 'Tên đăng nhập này đã tồn tại!');
            return FALSE;
        }
        return TRUE;
    }
} 