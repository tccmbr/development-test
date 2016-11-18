<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Product
 * @author Ewerton Oliveira
 */
class Product extends CI_Controller
{
    const REDIRECT_TO = 'product';

    public function new()
    {
        $this->load->view('product/new');
    }

    public function show($id = 0)
    {
        if ($id > 0) {
            $result = $this->Product_model->findOneBy(['product_id' => $id]);
        } else {
            redirect(self::REDIRECT_TO);
        }

        $this->load->view('templates/store', array(
            'title' => $result->product_name,
            'template_page' => 'product/show',
            'page' => 'index',
            'product' => $result
        ));
    }

    public function edit($id = 0)
    {
        if ($id > 0) {

        } else {
            redirect(self::REDIRECT_TO);
        }

        $this->load->view('product/edit');
    }

    public function delete($id = 0)
    {
        if ($id > 0) {
            if ($this->Product_model->findOneBy(['product_id' => $id]))
                $this->Product_model->delete(['product_id' => $id]);
        }

        redirect(self::REDIRECT_TO);
    }
}