<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function index() {
        $this->load->model('contact/M_contact');
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Họ tên', 'required|trim|min_length[4]|max_length[60]|regex_match[/^[\p{L} ]+$/u]');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|trim|regex_match[/^0[0-9]{9,10}$/]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|max_length[60]');
            $this->form_validation->set_rules('car_model', 'Dòng xe', 'required|trim');
            $this->form_validation->set_rules('location', 'Đại lý', 'required|trim');
            $this->form_validation->set_rules('message', 'Nội dung', 'trim|max_length[500]');
            
            if ($this->form_validation->run() == TRUE) {
                $data = [
                    'full_name' => $this->input->post('name'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('location'),
                    'subject' => 'Đăng ký lái thử - ' . $this->input->post('car_model'),
                    'message' => $this->input->post('message'),
                    'add_time' => time(),
                    'is_view' => 0,
                    'status' => 1,
                    'view_time' => 0
                ];
                
                $ok = $this->M_contact->add($data);
                if ($ok) {
                    $this->session->set_flashdata('testdrive_success', 'Đăng ký lái thử thành công! Chúng tôi sẽ liên hệ bạn sớm nhất.');
                } else {
                    $this->session->set_flashdata('testdrive_error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
                }
                redirect('dang-ky-lai-thu');
            } else {
                $this->session->set_flashdata('testdrive_error', validation_errors());
                redirect('dang-ky-lai-thu');
            }
        }
        
        $this->load->view('register');
    }
} 