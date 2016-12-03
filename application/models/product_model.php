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

    /**
     * @return mixed
     */
    public function count($where = null)
    {
        if (!is_null($where)) $this->db->where($where);
        $this->db->where('product_stock_quantity > 0');
        return $this->db->count_all_results($this->table);
    }

    public function findRandom()
    {
        $this->db->select_max('product_id');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $maxId = $query->result()[0];
            $this->db->where('product_id >= CEIL(RAND() * '.$maxId->product_id.')');
            $this->db->where('product_stock_quantity > 0');
            $this->db->limit(10, 0);
            $query = $this->db->get($this->table);

            if ($query->num_rows() > 0)
                return $query->result();
        }

        return [];
    }

    public function find($limit = 10, $currentPage = 1, $where = null, $orderBy = 'product_id DESC')
    {
        $offset = $currentPage > 1 ? $currentPage * $limit - $limit : 0;
        if (!is_null($where)) $this->db->where($where);
        $this->db->where('product_stock_quantity > 0');
        $this->db->order_by($orderBy);
        $this->db->limit($limit, $offset);
        $query = $this->db->get($this->table);

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

    public function insert(array $products)
    {
        return $this->db->insert_batch($this->table, $products);
    }

    public function update($product)
    {
        return $this->db->update($this->table, $product, array('product_id' => $product->product_id));
    }

    public function delete($product)
    {
        return $this->db->delete($this->table, array('product_id' => $product->product_id));
    }
}