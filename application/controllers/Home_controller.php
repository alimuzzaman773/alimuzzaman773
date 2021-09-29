<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('users', '', TRUE);
    }

    public function index() {
        $this->load->view('home_view');
    }

    public function signin() {
        if ($this->input->is_ajax_request()) {
            $token = $this->security->get_csrf_hash();
            $post_data = filter_input_array(INPUT_POST);
            $params = array();
            $data = array();
            $formData = (isset($post_data) && isset($post_data['formData']) && !empty($post_data['formData']) ? parse_str($post_data['formData'], $params) : '');
            $username = (isset($params) && isset($params['email']) && !empty($params['email']) ? Sanitize_input_data($params['email']) : '');
            $password = (isset($params) && isset($params['password']) && !empty($params['password']) ? md5(Sanitize_input_data($params['password'])) : '');
            if (!empty($username) && !empty($password)) {
                $password_check = false;
                $user_details = $this->users->get_user_by_email($username);
                $org_password = (!empty($user_details) && isset($user_details->password) & !empty($user_details->password) ? $user_details->password : '');
                if ($org_password === $password) {
                    $password_check = true;
                }

                if (!empty($user_details) && $password_check) {
                    $org_uid = (!empty($user_details) && isset($user_details->id) & !empty($user_details->id) ? $user_details->id : '');
                    $org_email = (!empty($user_details) && isset($user_details->email) & !empty($user_details->email) ? $user_details->email : '');
                    $newdata = array(
                        'uid' => "$org_uid",
                        'email' => "$org_email",
                        'user_pass' => $org_password,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($newdata);
                    $data['redirect'] = base_url('contact');
                    $data['error'] = 0;
                    $data['token'] = $token;
                } else {
                    $data['message'] = "User name or password is invalid.";
                    $data['error'] = 1;
                    $data['token'] = $token;
                }
            } else {
                $data['message'] = "Fill all the field .";
                $data['error'] = 1;
                $data['token'] = $token;
            }
            echo json_encode($data);
            exit();
        }
    }

    public function signup() {
        if ($this->input->is_ajax_request()) {
            $token = $this->security->get_csrf_hash();
            $post_data = filter_input_array(INPUT_POST);
            $params = array();
            $return = array();
            $suceess = false;
            $formData = (isset($post_data) && isset($post_data['formData']) && !empty($post_data['formData']) ? parse_str($post_data['formData'], $params) : '');
            $email = (isset($params) && isset($params['remail']) && !empty($params['remail']) ? trim(strtolower(Sanitize_input_data($params['remail']))) : '');
            $rpassword = (isset($params) && isset($params['rpassword']) && !empty($params['rpassword']) ? trim(Sanitize_input_data($params['rpassword'])) : '');
            $password_confirmation = (isset($params) && isset($params['password_confirmation']) && !empty($params['password_confirmation']) ? trim(Sanitize_input_data($params['password_confirmation'])) : '');

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $return['suceess'] = 0;
                $return['token'] = $token;
                $return['msg'] = '<div class="alert alert-danger text-center" role="alert"><div class="alert-text">Enter valid email address !</div></div>';
            } else {
                if ($rpassword === $password_confirmation) {
                    $org_user_data['password'] = md5($rpassword);
                    $org_user_data['email'] = (isset($email) && !empty($email) ? $email : '');
                    $result = $this->users->add_user_details($org_user_data);
                    if ($result) {
                        $return['suceess'] = 1;
                        $return['token'] = $token;
                        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center" role="alert"><div class="alert-text">Registration successfully !</div></div>');
                    } else {
                        $return['suceess'] = 0;
                        $return['token'] = $token;
                        $return['msg'] = '<div class="alert alert-danger text-center" role="alert"><div class="alert-text">data add failed !</div></div>';
                    }
                } else {
                    $return['suceess'] = 0;
                    $return['token'] = $token;
                    $return['msg'] = '<div class="alert alert-danger text-center" role="alert"><div class="alert-text">Password does not matched !</div></div>';
                }
            }
            echo json_encode($return);
        }
    }

    public function logout() {
        session_destroy();
        redirect();
    }

}
