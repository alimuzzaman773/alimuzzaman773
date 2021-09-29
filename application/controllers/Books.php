<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function book_list() {
        $data = array();
        return $this->load->view('route_page/books/view_books_list_route_view', $data);
    }

    public function add_edit_book() {
        $data = array();
        return $this->load->view('route_page/books/add_edit_book_route_view', $data);
    }

    public function add_update_book() {
        $form_data = json_decode(file_get_contents("php://input"));
        $return = array();
        $add_book_data = array();
        $add_book_data_arr = array();
        $books = (isset($form_data) && !empty($form_data) ? $form_data : array());
        $count = (!empty($books) ? count($books) : '');
        for ($i = 0; $i < $count; $i++) {
            $add_book_data['id'] = $id = (isset($books[$i]->id) && !empty($books[$i]->id) ? $books[$i]->id : '');
            $add_book_data['name'] = (isset($books[$i]->name) && !empty($books[$i]->name) ? $books[$i]->name : '');
            $add_book_data['isbn'] = (isset($books[$i]->isbn) && !empty($books[$i]->isbn) ? $books[$i]->isbn : '');
            $add_book_data['author'] = (isset($books[$i]->author) && !empty($books[$i]->author) ? $books[$i]->author : '');
            if (!empty($id)):
                $add_book_data['updated_on'] = date('Y-m-d H:i:s');
            endif;
            $add_book_data_arr[] = $add_book_data;
        }
        if (!empty($id)) {
            $result = update_multiple_data('route_books', $add_book_data_arr, 'id');
            $book_details = get_data_from_table_by_id('route_books', $id);
        } else {
            $result = add_multiple_data('route_books', $add_book_data_arr);
        }
        if ($result) {
            $return['book_details'] = (!empty($id) ? $book_details : '');
            $return['success'] = 1;
            $return['msg'] = (!empty($id) ? 'Data updated successfully !' : 'Data added successfully !');
        } else {
            $return['success'] = 0;
            $return['book_details'] = (!empty($id) ? $book_details : '');
            $return['msg'] = (!empty($id) ? 'Data update failed !' : 'Data add failed !');
        }
        echo json_encode($return);
    }

    public function delete_book() {
        $post_data = filter_input_array(INPUT_POST);
        $return = array();
        $id = (isset($post_data) && isset($post_data['id']) && !empty($post_data['id']) ? $post_data['id'] : '');
        $result = delete_data_from_table('route_books', $id);
        $book_lists = get_all_data_from_table('route_books');
        if ($result) {
            $return['book_lists'] = $book_lists;
            $return['success'] = 1;
            $return['msg'] = 'Data deleted successfully !';
        } else {
            $return['book_lists'] = $book_lists;
            $return['success'] = 0;
            $return['msg'] = 'Data delete failed !';
        }
        echo json_encode($return);
    }

    public function get_books() {
        $return = array();
        $books_list = get_all_data_from_table('route_books');
        $return['book_lists'] = $books_list;
        echo json_encode($return);
    }

    public function get_book_details() {
        $return = array();
        $post_data = filter_input_array(INPUT_POST);
        $id = (isset($post_data) && isset($post_data['bookId']) && !empty($post_data['bookId']) ? $post_data['bookId'] : '');
        $book_details = get_data_from_table_by_id('route_books', $id);
        $return['book_details'] = $book_details;
        echo json_encode($return);
    }

}
