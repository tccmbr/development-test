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

    public function _formValidation()
    {
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
        $this->form_validation->set_message('required', 'Campo obrigatório');
        $this->form_validation->set_message('decimal', 'Deve conter um número decimal');
        $this->form_validation->set_message('max_length', 'Número máximo de caracteres atingidos');
        $this->form_validation->set_message('greater_than', 'Deve ser maior que o valor informado');
        $this->form_validation->set_rules('product_name', 'Produto', 'trim|required|min_length[4]|max_length[100]');
        $this->form_validation->set_rules('product_price', 'Preço', 'trim|required|greater_than[0]|max_length[7]|decimal');
        $this->form_validation->set_rules('product_stock_quantity', 'Quantidade', 'trim|required|greater_than[0]|integer');
    }

    public function new()
    {
        if ($this->session->userdata('logged_in') !== TRUE)
            redirect(self::REDIRECT_TO);

        $this->_formValidation();

        if ($this->form_validation->run() == TRUE) {
            $this->db->trans_begin();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->Product_model->product_name = $this->input->post('product_name');
                $this->Product_model->product_price = $this->input->post('product_price');
                $this->Product_model->product_stock_quantity = $this->input->post('product_stock_quantity');
                $this->Product_model->insert();
                $this->db->trans_commit();
                $this->session->set_flashdata('message', array('success' => 'Produto salvo com sucesso!'));
                redirect('product/new');
            }
        }

        $this->load->view('templates/store', array(
            'title' => 'Novo',
            'templatePage' => 'product/new',
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

        $this->_formValidation();
        if ($id <= 0) redirect(self::REDIRECT_TO);

        $product = $this->Product_model->findOneBy(array('product_id' => $id));

        if ($this->form_validation->run() == TRUE) {
            $this->db->trans_begin();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $product->product_name = $this->input->post('product_name');
                $product->product_price = $this->input->post('product_price');
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