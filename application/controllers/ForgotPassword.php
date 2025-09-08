<?php
class ForgotPassword extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
    }
    public function index() {
        if ($this->input->method() === 'post') {
            $email = $this->input->post('email');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('forgot-password');
            }
            $user = $this->db->where('email', $email)->get('users')->row();
            if ($user) {
                $reset_token = bin2hex(random_bytes(32));
                $this->db->where('userid', $user->userid)->update('users', ['reset_token' => $reset_token, 'reset_token_expire' => time() + 3600]);
                $reset_link = base_url('reset-password?token=' . $reset_token);
                $subject = 'Đặt lại mật khẩu Evo Car';
                $message = '<p>Chào ' . htmlspecialchars($user->full_name) . ',</p>' .
                    '<p>Bạn vừa yêu cầu đặt lại mật khẩu. Nhấn vào link bên dưới để đặt lại mật khẩu mới (có hiệu lực trong 1 giờ):</p>' .
                    '<p><a href="' . $reset_link . '">' . $reset_link . '</a></p>' .
                    '<p>Nếu bạn không yêu cầu, vui lòng bỏ qua email này.</p>';
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
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();
                $this->session->set_flashdata('success', 'Đã gửi email hướng dẫn đặt lại mật khẩu! Vui lòng kiểm tra email.');
                redirect('forgot-password');
            } else {
                $this->session->set_flashdata('error', 'Email không tồn tại trong hệ thống!');
                redirect('forgot-password');
            }
        }
        $this->load->view('forgot_password');
    }
} 