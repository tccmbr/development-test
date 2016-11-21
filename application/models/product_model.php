<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class product
 *
 * @author Ewerton Oliveira
 */
class Product_model extends CI_Model
{
    /**
     * @var int
     */
    public $product_id;
    /**
     * @var string
     */
    public $product_name;
    /**
     * @var float
     */
    public $product_price;
    /**
     * @var int
     */
    public $product_stock_quantity;
    /**
     * @var string
     */
    private $table = 'products';

    public function clearAllCache()
    {
        $this->db->cache_delete_all();
    }

    /**
     * @return mixed
     */
    public function count($where = null)
    {
        $this->db->cache_on();
        if (!is_null($where)) $this->db->where($where);
        $this->db->where('product_stock_quantity > 0');
        return $this->db->count_all_results($this->table);
    }

    public function random($products)
    {
        $data = array();
        foreach ($products as $product) {
            $data[] = $product;
        }
        shuffle($data);
        return $data;
    }

    public function find($limit = 10, $currentPage = 1, $where = null, $orderBy = 'product_id DESC')
    {
        $offset = $currentPage > 1 ? $currentPage * $limit - $limit : 0;
        $this->db->cache_on();
        $this->db->start_cache();
        if (!is_null($where)) $this->db->where($where);
        $this->db->where('product_stock_quantity > 0');
        $this->db->order_by($orderBy);
        $this->db->limit($limit, $offset);
        $query = $this->db->get($this->table);
        $this->db->stop_cache();

        if ($query->num_rows() > 0)
            return $query->result();

        return [];
    }

    public function findOneBy($where)
    {
        $result = $this->db->get_where($this->table, $where, 1, 0);

        if ($result->num_rows() > 0)
            return $result->result()[0];

        return false;
    }

    public function insert()
    {
        $this->clearAllCache();
        return $this->db->insert($this->table, $this);
    }

    public function update($product)
    {
        $this->clearAllCache();
        return $this->db->update($this->table, $product, array('product_id' => $product->product_id));
    }

    public function delete($product)
    {
        $this->clearAllCache();
        return $this->db->delete($this->table, array('product_id' => $product->product_id));
    }
}