<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Helper
 * Các function hỗ trợ authentication
 */

if (!function_exists('is_logged_in')) {
    /**
     * Kiểm tra user đã đăng nhập chưa
     */
    function is_logged_in() {
        $CI =& get_instance();
        return $CI->session->userdata('logged_in') === TRUE;
    }
}

if (!function_exists('get_user_id')) {
    /**
     * Lấy user ID hiện tại
     */
    function get_user_id() {
        $CI =& get_instance();
        return $CI->session->userdata('user_id');
    }
}

if (!function_exists('get_user_email')) {
    /**
     * Lấy email user hiện tại
     */
    function get_user_email() {
        $CI =& get_instance();
        return $CI->session->userdata('email');
    }
}

if (!function_exists('get_user_fullname')) {
    /**
     * Lấy tên đầy đủ user hiện tại
     */
    function get_user_fullname() {
        $CI =& get_instance();
        return $CI->session->userdata('fullname');
    }
}

if (!function_exists('require_login')) {
    /**
     * Yêu cầu user phải đăng nhập
     */
    function require_login() {
        if (!is_logged_in()) {
            $CI =& get_instance();
            $CI->session->set_flashdata('error', 'Vui lòng đăng nhập để tiếp tục!');
            redirect('login');
        }
    }
}

if (!function_exists('redirect_if_logged_in')) {
    /**
     * Redirect nếu user đã đăng nhập
     */
    function redirect_if_logged_in($redirect_url = '') {
        if (is_logged_in()) {
            redirect($redirect_url ?: base_url());
        }
    }
}

if (!function_exists('get_user_data')) {
    /**
     * Lấy toàn bộ thông tin user từ session
     */
    function get_user_data() {
        $CI =& get_instance();
        return array(
            'user_id' => $CI->session->userdata('user_id'),
            'email' => $CI->session->userdata('email'),
            'fullname' => $CI->session->userdata('fullname'),
            'logged_in' => $CI->session->userdata('logged_in')
        );
    }
} 