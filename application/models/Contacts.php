<?php

class Contacts extends CI_Model {

    protected $table = 'contact_book';

    function __construct() {
        parent::__construct();
    }

    function get_data_from_table_by_name_phone_and_created_date_range($name, $phone, $created_date_from, $created_date_to) {
        $this->db->select('*')
                ->from($this->table);
        if (!empty($created_date_from) && !empty($created_date_to)) {
            $this->db->where("DATE_FORMAT(created_on,'%Y-%m-%d') >='$created_date_from'");
            $this->db->where("DATE_FORMAT(created_on,'%Y-%m-%d') <='$created_date_to'");
        } else if (!empty($created_date_from) && empty($created_date_to)) {
            $this->db->where("DATE_FORMAT(created_on,'%Y-%m-%d') >='$created_date_from'");
        } else if (empty($created_date_from) && !empty($created_date_to)) {
            $this->db->where("DATE_FORMAT(created_on,'%Y-%m-%d') <='$created_date_to'");
        }
        if (!empty($name) && !empty($phone)) {
            $this->db->like('name', $name);
            $this->db->or_like('phone', $phone, 'after');
        } else if (!empty($name) && empty($phone)) {
            $this->db->like('name', $name);
        } else if (empty($name) && !empty($phone)) {
            $this->db->like('phone', $phone, 'after');
        }
        $result = $this->db->get()
                ->result();
        return $result;
    }

}
