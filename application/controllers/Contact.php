<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        $data['title'] = 'Welcome to contact Management';
        $data['dashboard_title'] = 'Welcome to contact Management';
        $data['user_email'] = $this->session->userdata('email');
        $data['user_id'] = $uid = $this->session->userdata('uid');
        $data['body_template'] = 'contact_list/contact_list_view';

        $this->load->view('site_template', $data);
    }

    public function add_update_contact() {
        $post_data = filter_input_array(INPUT_POST);
        $return = array();
        $contact_data = array();
        $errors = array();
        if (empty($post_data['name'])):
            $errors['name'] = 'Name is required.';
        endif;
        if (empty($post_data['phone'])):
            $errors['phone'] = 'Phone is required.';
        endif;
        if (empty($post_data['company'])):
            $errors['company'] = 'Company is required.';
        endif;
        if (empty($post_data['address'])):
            $errors['address'] = 'Adress is required.';
        endif;
        if (!empty($errors)) {
            $contact_list = get_all_data_from_table('contact_book');
            $return['contact_list'] = $contact_list;
            $return['errors'] = $errors;
        } else {
            $contact_data['id'] = $id = (isset($post_data) && isset($post_data['id']) && !empty($post_data['id']) ? trim(Sanitize_input_data($post_data['id'])) : '');
            $contact_data['name'] = (isset($post_data) && isset($post_data['name']) && !empty($post_data['name']) ? trim(Sanitize_input_data($post_data['name'])) : '');
            $contact_data['phone'] = (isset($post_data) && isset($post_data['phone']) && !empty($post_data['phone']) ? trim(Sanitize_input_data($post_data['phone'])) : '');
            $contact_data['company'] = (isset($post_data) && isset($post_data['company']) && !empty($post_data['company']) ? trim(Sanitize_input_data($post_data['company'])) : '');
            $contact_data['address'] = (isset($post_data) && isset($post_data['address']) && !empty($post_data['address']) ? trim(Sanitize_input_data($post_data['address'])) : '');
            if (!empty($id)) {
                $contact_data['updated_on'] = date('Y-m-d H:i:s');
                $result = update_data('contact_book', $contact_data);
            } else {
                $result = add_data('contact_book', $contact_data);
            }
            $contact_list = get_all_data_from_table('contact_book');
            if ($result) {
                $return['contact_list'] = $contact_list;
                $return['success'] = 1;
                $return['msg'] = 'Data added successfully !';
            } else {
                $return['contact_list'] = $contact_list;
                $return['success'] = 0;
                $return['msg'] = 'Data add failed !';
            }
        }
        echo json_encode($return);
    }

    public function delete_contact() {
        $post_data = filter_input_array(INPUT_POST);
        $return = array();
        $id = (isset($post_data) && isset($post_data['id']) && !empty($post_data['id']) ? $post_data['id'] : '');
        $result = delete_data_from_table('contact_book', $id);
        $contact_list = get_all_data_from_table('contact_book');
        if ($result) {
            $return['contact_list'] = $contact_list;
            $return['success'] = 1;
            $return['msg'] = 'Data deleted successfully !';
        } else {
            $return['contact_list'] = $contact_list;
            $return['success'] = 0;
            $return['msg'] = 'Data delete failed !';
        }
        echo json_encode($return);
    }

    public function get_contacts() {
        $return = array();
        $contact_list = get_all_data_from_table('contact_book');
        $return['contact_list'] = $contact_list;
        echo json_encode($return);
    }

}
