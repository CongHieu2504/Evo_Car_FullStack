<?php

class M_contactform extends CI_Model {

    public $_table_name = 'contact';

    public function __construct() {
        parent::__construct();
    }

    public function add($data = array()) {
        if (empty($data)) {
            return FALSE;
        }
        $query = $this->db->insert($this->_table_name, $data);

        return (isset($query)) ? TRUE : FALSE;
    }
    
    public function get($id) {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->where($this->_table_name . '.id', $id);

        $query = $this->db->get();

        return $query->row_array();
    }

    public function update($id, $data) {
        if (empty($data)) {
            return FALSE;
        }
        $this->db->where('id', $id);
        $query = $this->db->update($this->_table_name, $data);

        return (isset($query)) ? true : false;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $query = $this->db->delete($this->_table_name);

        return (isset($query)) ? true : false;
    }

    public function get_comments_by_subject($subject) {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->where('subject', $subject);
        $this->db->where('status', 1);
        $this->db->order_by('add_time', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

}

/* End of file m_contactform.php */ 