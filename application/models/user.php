<?php

class User extends CI_Model
{
    private $table = 'user';
    public $id;
    public $state = 1;
    public $username;
    public $password;

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