<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function user_list() {
        $data = array();
        return $this->load->view('route_page/user/view_user_list_route_view', $data);
    }

    public function add_edit_user() {
        $data = array();
        return $this->load->view('route_page/user/add_edit_user_route_view', $data);
    }

    public function add_update_user() {
        $post_data = filter_input_array(INPUT_POST);
        $return = array();
        $user_data = array();
        $errors = array();
        $userId = (isset($post_data) && isset($post_data['userId']) && !empty($post_data['userId']) ? trim(Sanitize_input_data($post_data['userId'])) : '');
        $form_data = (isset($post_data) && isset($post_data['user']) && !empty($post_data['user']) ? $post_data['user'] : array());
        $email_exist = get_data_from_table_by_column_value('users', 'email', $form_data['email']);
        $users_email = get_data_from_table_by_column_value('users', 'id', $userId);
        $errors['email'] = (empty($form_data['email']) ? 'valid email address required.' : ((!empty($email_exist) && !empty($userId)) && ($email_exist->email === $users_email->email) ? '' : ((!empty($email_exist) && !empty($userId)) && ($email_exist->email !== $users_email->email) ? 'Email already exists.' : ((!empty($email_exist) && empty($userId)) ? 'Email already exists.' : ''))));
        $errors['password'] = (empty($form_data['password']) && empty($userId) ? 'Password  required.' : (!empty($userId) && empty($form_data['password']) && !empty($form_data['password_confirmation']) ? 'Password  required.' : ''));
        $errors['password_confirmation'] = (empty($form_data['password_confirmation']) && empty($userId) ? 'Confirm Password  required.' : (!empty($userId) && empty($form_data['password_confirmation']) && !empty($form_data['password']) ? 'Confirm Password  required.' : ''));
        if (!empty($userId)):
            $user_data['id'] = $userId;
        endif;
        if (isset($form_data) && isset($form_data['email']) && !empty($form_data['email'])):
            $user_data['email'] = trim(Sanitize_input_data($form_data['email']));
        endif;
        if (isset($form_data) && isset($form_data['password']) && !empty($form_data['password'])):
            $user_data['password'] =  md5(trim(Sanitize_input_data($form_data['password'])));
        endif;
        if ((!empty($form_data['password']) && !empty($form_data['password_confirmation'])) && ($form_data['password'] !== $form_data['password_confirmation'])):
            $errors['password'] = 'Password does not match';
            $errors['password_confirmation'] = 'Password does not match';
        endif;

        if (!empty($errors['email']) || !empty($errors['password']) || !empty($errors['password_confirmation'])) {
            $return['errors'] = $errors;
        } else {
            if (!empty($userId)) {
                $result = update_data('users', $user_data);
            } else {
                $result = add_data('users', $user_data);
            }
            if ($result) {
                $return['success'] = 1;
                $return['msg'] = (!empty($userId) ? 'Data updated successfully !' : 'Data added successfully !');
            } else {
                $return['success'] = 0;
                $return['msg'] = (!empty($userId) ? 'Data update failed !' : 'Data add failed !');
            }
        }
        echo json_encode($return);
    }

    public function delete_user() {
        $post_data = filter_input_array(INPUT_POST);
        $return = array();
        $id = (isset($post_data) && isset($post_data['id']) && !empty($post_data['id']) ? $post_data['id'] : '');
        $result = delete_data_from_table('users', $id);
        $user_list = get_all_data_from_table('users');
        if ($result) {
            $return['users_list'] = $user_list;
            $return['success'] = 1;
            $return['msg'] = 'Data deleted successfully !';
        } else {
            $return['users_list'] = $user_list;
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

    public function get_user_details() {
        $return = array();
        $post_data = filter_input_array(INPUT_POST);
        $id = (isset($post_data) && isset($post_data['userId']) && !empty($post_data['userId']) ? $post_data['userId'] : '');
        $user_details = get_data_from_table_by_id('users', $id);
        $return['user_details'] = $user_details;
        echo json_encode($return);
    }

}
