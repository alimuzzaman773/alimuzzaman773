<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Add_book extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        $data['title'] = 'Welcome to contact Management';
        $data['dashboard_title'] = 'Welcome to contact Management';
        $data['user_email'] = $this->session->userdata('email');
        $data['user_id'] = $uid = $this->session->userdata('uid');
        $data['body_template'] = 'add_book/add_book_view';

        $this->load->view('site_template', $data);
    }

    public function add_update() {
        $form_data = json_decode(file_get_contents("php://input"));
        $return = array();
        $add_book_data = array();
        $add_book_data_arr = array();
        $user_deatails = (isset($form_data) && isset($form_data[0]) && !empty($form_data[0]) && isset($form_data[0]->user) && !empty($form_data[0]->user) ? $form_data[0]->user : '');
        $books = (isset($form_data) && isset($form_data[1]) && !empty($form_data[1]) ? $form_data[1] : '');
        $count = (!empty($books) ? count($books) : '');
        $user_id = (!empty($user_deatails) ? $user_deatails->id : '');
        for ($i = 0; $i < $count; $i++) {
            $add_book_data['id'] = $id = (isset($books[$i]->id) && !empty($books[$i]->id) ? $books[$i]->id : '');
            $add_book_data['name'] = (isset($books[$i]->name) && !empty($books[$i]->name) ? $books[$i]->name : '');
            $add_book_data['isbn'] = (isset($books[$i]->isbn) && !empty($books[$i]->isbn) ? $books[$i]->isbn : '');
            $add_book_data['author'] = (isset($books[$i]->author) && !empty($books[$i]->author) ? $books[$i]->author : '');
            $add_book_data['user_id'] = (isset($user_id) && !empty($user_id) ? $user_id : '');
            if (!empty($id)):
                $add_book_data['updated_on'] = date('Y-m-d H:i:s');
            endif;
            $add_book_data_arr[] = $add_book_data;
        }
        if (!empty($id)) {
            $result = update_multiple_data('books', $add_book_data_arr, 'id');
        } else {
            $result = add_multiple_data('books', $add_book_data_arr);
        }
        $user_all_book_list = get_all_book_from_book_table_by_user_id($user_id);
        if ($result) {
            $return['user_all_book_list'] = $user_all_book_list;
            $return['success'] = 1;
            $return['msg'] = (!empty($id) ? 'Data updated successfully !':'Data added successfully !');
        } else {
            $return['user_all_book_list'] = $user_all_book_list;
            $return['success'] = 0;
            $return['msg'] = (!empty($id) ? 'Data update failed !':'Data add failed !');
        }
        echo json_encode($return);
    }

    public function delete_book() {
        $post_data = filter_input_array(INPUT_POST);
        $return = array();
        $id = (isset($post_data) && isset($post_data['id']) && !empty($post_data['id']) ? $post_data['id'] : '');
        $user_id = (isset($post_data) && isset($post_data['user_id']) && !empty($post_data['user_id']) ? $post_data['user_id'] : '');
        $result = delete_data_from_table('books', $id);
        $user_all_book_list = get_all_book_from_book_table_by_user_id($user_id);
        if ($result) {
            $return['books_list'] = $user_all_book_list;
            $return['success'] = 1;
            $return['msg'] = 'Data deleted successfully !';
        } else {
            $return['books_list'] = $user_all_book_list;
            $return['success'] = 0;
            $return['msg'] = 'Data delete failed !';
        }
        echo json_encode($return);
    }

    public function get_users() {
        $return = array();
        $users_list = get_all_data_from_table('users');
        $return['users_list'] = $users_list;
        echo json_encode($return);
    }

    public function get_books() {
        $return = array();
        $books_list = get_all_data_from_table('books');
        $return['books_list'] = $books_list;
        echo json_encode($return);
    }

}
