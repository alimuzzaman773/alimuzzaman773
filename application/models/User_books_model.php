<?php

class User_books_model extends CI_Model {

    public $user_id;
    protected $table = 'user_books';

    function __construct() {
        parent::__construct();
    }
    function get_user_books_with_details_by_user_id($user_id) {
        $result = $this->db->select('ub.id,ub.route_books_id,rb.name,rb.isbn,rb.author,rb.created_on,u.email')
                ->from('user_books as ub')
                ->join('route_books rb', 'ub.route_books_id = rb.id', 'left')
                ->join('users u', 'ub.user_id = u.id', 'left')
                ->where('ub.user_id', $user_id)
                ->order_by('ub.id','desc')
                ->get()
                ->result();
        return $result;
    }
    function get_user_books_with_details_by_id($id) {
        $result = $this->db->select('ub.id,ub.route_books_id,rb.name,rb.isbn,rb.author,rb.created_on,u.email')
                ->from('user_books as ub')
                ->join('route_books rb', 'ub.route_books_id = rb.id', 'left')
                ->join('users u', 'ub.user_id = u.id', 'left')
                ->where('ub.id', $id)
                ->get()
                ->row();
        return $result;
    }

}
