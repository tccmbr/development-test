<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Order_model
 * @author Ewerton Oliveira
 */
class Order_model extends CI_Model
{
    /**
     * @var int
     */
    public $order_id;
    /**
     * @var int
     */
    public $order_code;
    /**
     * @var int
     */
    public $product_id;
    /**
     * @var string
     */
    private $table = 'orders';

    public function find($where = null)
    {
        $this->db->cache_on();
        $this->db->join('products','products.product_id = '.$this->table.'.product_id');
        if (!is_null($where)) $this->db->where($where);
        $this->db->order_by($this->table.'.product_id DESC');
        $query = $this->db->get($this->table);
        $this->db->cache_off();
        
        if ($query->num_rows() > 0)
            return $query->result();

        return [];
    }

    public function insert(array $data)
    {
        return $this->db->insert_batch($this->table, $data);
    }
}