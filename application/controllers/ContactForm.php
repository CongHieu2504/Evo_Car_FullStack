<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactForm extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session']);
        $this->load->model('M_contactform');
    }
    
    public function index() {
        // Xử lý form submission
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Họ tên', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|trim');
            $this->form_validation->set_rules('subject', 'Tiêu đề', 'required|trim');
            $this->form_validation->set_rules('message', 'Nội dung', 'required|trim');
            
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'full_name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'subject' => $this->input->post('subject'),
                    'message' => $this->input->post('message'),
                    'add_time' => time(),
                    'is_view' => 0,
                    'status' => 1,
                    'view_time' => 0
                );
                
                $result = $this->M_contactform->add($data);
                
                if ($result) {
                    $this->session->set_flashdata('contact_success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
                } else {
                    $this->session->set_flashdata('contact_error', 'Có lỗi xảy ra! Vui lòng thử lại sau.');
                }
                
                redirect('lien-he-moi');
            }
        }
        
        // Load view
        $this->load->view('contact_form');
    }

    public function test_flash() {
        $this->session->set_flashdata('test', 'Test flashdata');
        redirect('contactform/show_flash');
    }

    public function show_flash() {
        echo $this->session->flashdata('test');
        echo '<br><a href="'.site_url('contactform/show_flash').'">Reload</a>';
    }
} 