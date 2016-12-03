<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Product
 * @author Ewerton Oliveira
 */
class Product extends CI_Controller
{
    const REDIRECT_TO = 'store';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    public function add()
    {
        if ($this->session->userdata('logged_in') !== TRUE)
            redirect(self::REDIRECT_TO);

        if ($this->input->post('products')) {
            $this->db->trans_begin();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $products = $this->input->post('products');
                $this->Product_model->insert($products);

                $this->db->trans_commit();
                $this->session->set_flashdata('message', array('success' => 'Produto salvo com sucesso!'));
                redirect('product/add');
            }
        }
        
        $this->load->view('templates/store', array(
            'title' => 'Novo',
            'templatePage' => 'product/add',
            'flashMessage' => $this->session->flashdata('message')
        ));
    }

    public function show($id = 0)
    {
        if ($id <= 0) redirect(self::REDIRECT_TO);

        $result = $this->Product_model->findOneBy(['product_id' => $id]);

        $this->load->view('templates/store', array(
            'title' => $result->product_name,
            'templatePage' => 'product/show',
            'product' => $result
        ));
    }

    public function edit($id = 0)
    {
        if ($this->session->userdata('logged_in') !== TRUE)
            redirect(self::REDIRECT_TO);

        if ($id <= 0) redirect(self::REDIRECT_TO);

        $product = $this->Product_model->findOneBy(array('product_id' => $id));

        if ($this->input->post('product_name')) {
            $this->db->trans_begin();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $product->product_name = mb_strtoupper($this->input->post('product_name'),'utf-8');
                $product->product_price =
                    str_replace(',','.', str_replace('.','', $this->input->post('product_price')));
                $product->product_stock_quantity = $this->input->post('product_stock_quantity');
                $this->Product_model->update($product);
                $this->db->trans_commit();
                $this->session->set_flashdata('message', array('success' => 'Produto salvo com sucesso!'));
                redirect(current_url());
            }
        }

        $this->load->view('templates/store', array(
            'title' => 'Editar',
            'templatePage' => 'product/edit',
            'product' => $product,
            'flashMessage' => $this->session->flashdata('message')
        ));
    }

    public function delete($id = 0)
    {
        if ($this->session->userdata('logged_in') !== TRUE)
            redirect(self::REDIRECT_TO);

        if ($id > 0 && $product = $this->Product_model->findOneBy(array('product_id' => $id))) {
            $this->Product_model->delete($product);
            $this->session->set_flashdata('message', array('success' => 'Produto removido com sucesso!'));
        }

        redirect(self::REDIRECT_TO);
    }
}