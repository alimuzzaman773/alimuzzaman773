<?php

function Sanitize_input_data($val) {
    $val1 = trim($val);
    $val2 = htmlspecialchars($val1, ENT_QUOTES);
    $val3 = strip_tags($val2);
    $val4 = filter_var($val3, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $val4;
}

function add_data($table, $data) {
    $CI = &get_instance();
    $CI->load->database();
    $return = $CI->db->insert($table, $data);
    if ($return) {
        return $CI->db->insert_id();
    } else {
        return FALSE;
    }
}

function add_multiple_data($table, $data) {
    $CI = &get_instance();
    $CI->load->database();
    $return = $CI->db->insert_batch($table, $data);
    if ($return) {
        return $CI->db->insert_id();
    } else {
        return FALSE;
    }
}
function update_multiple_data($table, $data) {
    $CI = &get_instance();
    $CI->load->database();
    $return = $CI->db->update_batch($table, $data, 'id');
    if ($return) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function update_data($table, $data) {
    $CI = &get_instance();
    $CI->load->database();
    $CI->db->update($table, $data, array('id' => $data['id']));
    if ($CI->db->affected_rows() > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function get_all_data_from_table($table) {
    $CI = &get_instance();
    $CI->load->database();
    $result = $CI->db->select('*')
            ->from($table)
            ->order_by('id', 'desc')
            ->get()
            ->result();
    return $result;
}

function delete_data_from_table($table, $id) {
    $CI = &get_instance();
    $CI->load->database();
    $CI->db->where('id', $id)
            ->from($table)
            ->delete();
    if ($CI->db->affected_rows() > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function get_data_from_table_by_id($table, $id) {
    $CI = &get_instance();
    $CI->load->database();
    $result = $CI->db->select('*')
            ->from($table)
            ->where('id', $id)
            ->get()
            ->row();
    return $result;
}
function get_data_from_table_by_column_value($table,$column,$column_value) {
    $CI = &get_instance();
    $CI->load->database();
    $result = $CI->db->select('*')
            ->from($table)
            ->where($table.'.'.$column, $column_value)
            ->get()
            ->row();
    return $result;
}
function get_data_from_table_by_column_value_multiple($table,$column,$column_value) {
    $CI = &get_instance();
    $CI->load->database();
    $result = $CI->db->select('*')
            ->from($table)
            ->where($table.'.'.$column, $column_value)
            ->get()
            ->result();
    return $result;
}
function get_all_book_from_book_table_by_user_id($user_id) {
    $CI = &get_instance();
    $CI->load->database();
    $result = $CI->db->select('*')
            ->from('books')
            ->where('user_id', $user_id)
            ->get()
            ->result();
    return $result;
}
