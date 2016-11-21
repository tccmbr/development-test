<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public $id;
    public $state;
    public $username;
    public $password;
    private $table = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($where)
    {
        if ($where) {
            $query = $this->db->get_where($this->table, $where, 1, 0);
        } else {
            $query = $this->db->get($this->table);
        }

        return $query->result();
    }
}