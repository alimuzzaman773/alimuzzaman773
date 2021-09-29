<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class One_page_route extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        $data['title'] = 'Welcome to Book Management';
        $data['dashboard_title'] = 'Welcome to Book Management';
        $data['user_email'] = $this->session->userdata('email');
        $data['user_id'] = $uid = $this->session->userdata('uid');
        $data['body_template'] = 'route_page/site_template_route_index_view';

        $this->load->view('site_template', $data);
    }

}
