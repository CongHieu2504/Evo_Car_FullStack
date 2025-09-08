<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'users';
    }

    /**
     * Xác thực đăng nhập
     */
    public function authenticate($email, $password) {
        // Cho phép đăng nhập bằng username hoặc email
        $this->db->group_start();
        $this->db->where('username', $email);
        $this->db->or_where('email', $email);
        $this->db->group_end();
        $this->db->where('active', 1);
        $user = $this->db->get($this->table)->row();

        if ($user) {
            // Nếu là password cũ (md5)
            if (strlen($user->password) === 32 && md5($password) === $user->password) {
                // Đăng nhập thành công, chuyển sang password_hash
                $new_hash = password_hash($password, PASSWORD_DEFAULT);
                $this->update_user($user->userid, array('password' => $new_hash));
                return $user;
            }
            // Nếu là password_hash mới
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    /**
     * Tạo tài khoản mới
     */
    public function create_user($data) {
        // Chuyển đổi data để khớp với database
        $user_data = array(
            'username' => $data['username'],
            'full_name' => $data['fullname'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'email' => $data['email'],
            'phone' => $data['phone'],
            'active' => isset($data['active']) ? $data['active'] : 1,
            'activation_key' => isset($data['activation_key']) ? $data['activation_key'] : null,
            'created' => time(),
            'modified' => time()
        );
        $this->db->insert($this->table, $user_data);
        return $this->db->insert_id();
    }

    /**
     * Kiểm tra email đã tồn tại chưa
     */
    public function email_exists($email, $exclude_id = null) {
        $this->db->group_start();
        $this->db->where('username', $email);
        $this->db->or_where('email', $email);
        $this->db->group_end();
        if ($exclude_id) {
            $this->db->where('userid !=', $exclude_id);
        }
        return $this->db->get($this->table)->num_rows() > 0;
    }

    /**
     * Kiểm tra username đã tồn tại chưa
     */
    public function username_exists($username, $exclude_id = null) {
        $this->db->where('username', $username);
        if ($exclude_id) {
            $this->db->where('userid !=', $exclude_id);
        }
        return $this->db->get($this->table)->num_rows() > 0;
    }

    /**
     * Lấy thông tin user theo ID
     */
    public function get_user_by_id($id) {
        return $this->db->where('userid', $id)->get($this->table)->row();
    }

    /**
     * Cập nhật thông tin user
     */
    public function update_user($id, $data) {
        return $this->db->where('userid', $id)->update($this->table, $data);
    }

    /**
     * Thay đổi mật khẩu
     */
    public function change_password($user_id, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        return $this->db->where('userid', $user_id)->update($this->table, array('password' => $hashed_password));
    }

    public function phone_exists($phone, $exclude_id = null) {
        $this->db->where('phone', $phone);
        if ($exclude_id) {
            $this->db->where('userid !=', $exclude_id);
        }
        return $this->db->get($this->table)->num_rows() > 0;
    }
} 