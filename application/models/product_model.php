<?php

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
    protected $product_id;
    /**
     * @var string
     */
    protected $product_name;
    /**
     * @var float
     */
    protected $product_price;
    /**
     * @var int
     */
    protected $product_stock_quantity;
    /**
     * @var string
     */
    private $table = 'products';

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @param string $product_name
     */
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }

    /**
     * @return float
     */
    public function getProductPrice()
    {
        return $this->product_price;
    }

    /**
     * @param float $product_price
     */
    public function setProductPrice($product_price)
    {
        $this->product_price = $product_price;
    }

    /**
     * @return int
     */
    public function getProductStockQuantity()
    {
        return $this->product_stock_quantity;
    }

    /**
     * @param int $product_stock_quantity
     */
    public function setProductStockQuantity($product_stock_quantity)
    {
        $this->product_stock_quantity = $product_stock_quantity;
    }

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

    public function find($limit = 10, $currentPage = 1, $where = null, array $orderBy)
    {
        $offset = $currentPage > 1 ? $currentPage * $limit - $limit : 0;
        $this->db->cache_on();
        $this->db->start_cache();
        if (!is_null($where)) $this->db->where($where);
        $this->db->where('product_stock_quantity > 0');
        $this->db->order_by($orderBy[0], $orderBy[1]);
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
        return $this->db->insert($this->table, $this);
    }

    public function update()
    {
        return $this->db->update($this->table, $this, array('id' => $this->product_id));
    }

    public function delete()
    {
        return $this->db->delete($this->table, array('id' => $this->product_id));
    }
}