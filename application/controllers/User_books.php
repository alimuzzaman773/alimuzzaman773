<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_books extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_books_model', '', TRUE);
    }

    public function index() {
        
    }

    public function user_books_list() {
        $data = array();
        return $this->load->view('route_page/user_books/view_user_books_list_route_view', $data);
    }

    public function add_edit_user_books() {
        $data = array();
        return $this->load->view('route_page/user_books/add_edit_user_books_route_view', $data);
    }

    public function add_update_user_books() {
        $form_data = json_decode(file_get_contents("php://input"));
        $return = array();
        $add_route_book_data = array();
        $add_route_book_data_arr = array();
        $user_id = (isset($form_data) && isset($form_data[0]) && !empty($form_data[0]) ? $form_data[0] : '');
        $books = (isset($form_data) && isset($form_data[1]) && !empty($form_data[1]) ? $form_data[1] : '');
        $row_id = (isset($form_data) && isset($form_data[2]) && !empty($form_data[2]) ? $form_data[2] : '');
        $count = (!empty($books) ? count($books) : '');

        for ($i = 0; $i < $count; $i++) {
            $add_route_book_data['user_id'] = $user_id;
            $add_route_book_data['route_books_id'] = (isset($books[$i]->book->id) && !empty($books[$i]->book->id) ? $books[$i]->book->id : '');
            if (!empty($row_id)):
                $add_route_book_data['id'] = $row_id;
                $add_route_book_data['updated_on'] = date('Y-m-d H:i:s');
            endif;
            $add_route_book_data_arr[] = $add_route_book_data;
        }
        if (!empty($row_id)) {
            $result = update_multiple_data('user_books', $add_route_book_data_arr, 'id');
            $user_book_details = $this->user_books_model->get_user_books_with_details_by_id($row_id);
        } else {
            $result = add_multiple_data('user_books', $add_route_book_data_arr);
        }
        if ($result) {
            $return['user_book_details'] = (!empty($row_id) ? $user_book_details : '');
            $return['success'] = 1;
            $return['msg'] = (!empty($row_id) ? 'Data updated successfully !' : 'Data added successfully !');
        } else {
            $return['user_book_details'] = (!empty($row_id) ? $user_book_details : '');
            $return['success'] = 0;
            $return['msg'] = (!empty($row_id) ? 'Data update failed !' : 'Data add failed !');
        }
        echo json_encode($return);
    }

    public function get_user_details() {
        $post_data = filter_input_array(INPUT_POST);
        $return = array();
        $id = (isset($post_data) && isset($post_data['id']) && !empty($post_data['id']) ? $post_data['id'] : '');
        $user_details = get_data_from_table_by_id('users', $id);
        $return['user_details'] = $user_details;
        echo json_encode($return);
    }

    public function get_user_books() {
        $post_data = filter_input_array(INPUT_POST);
        $return = array();
        $id = (isset($post_data) && isset($post_data['userId']) && !empty($post_data['userId']) ? $post_data['userId'] : '');
        $user_all_book_list = $this->user_books_model->get_user_books_with_details_by_user_id($id);
        $return['user_all_book_list'] = $user_all_book_list;
        echo json_encode($return);
    }

    public function delete_book() {
        $post_data = filter_input_array(INPUT_POST);
        $return = array();
        $id = (isset($post_data) && isset($post_data['id']) && !empty($post_data['id']) ? $post_data['id'] : '');
        $userId = (isset($post_data) && isset($post_data['userId']) && !empty($post_data['userId']) ? $post_data['userId'] : '');
        $result = delete_data_from_table('user_books', $id);
        $user_all_book_list = $this->user_books_model->get_user_books_with_details_by_user_id($userId);
        if ($result) {
            $return['user_all_book_list'] = $user_all_book_list;
            $return['success'] = 1;
            $return['msg'] = 'Data deleted successfully !';
        } else {
            $return['user_all_book_list'] = $user_all_book_list;
            $return['success'] = 0;
            $return['msg'] = 'Data delete failed !';
        }
        echo json_encode($return);
    }

    public function user_book_details() {
        $return = array();
        $post_data = filter_input_array(INPUT_POST);
        $id = (isset($post_data) && isset($post_data['rowId']) && !empty($post_data['rowId']) ? $post_data['rowId'] : '');
        $user_book_details = get_data_from_table_by_id('user_books', $id);
        $return['user_book_details'] = $user_book_details;
        echo json_encode($return);
    }

}
