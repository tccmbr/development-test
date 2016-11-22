<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Store
 *
 * @author Ewerton Oliveira
 */
class Store extends CI_Controller
{
    public function index()
    {
        $this->load->library('pagination');
        $where = $this->input->get('search') ? 'product_name LIKE "%' . $this->input->get('search') . '%"' : null;

        $total_row = $this->Product_model->count($where);
        $config['base_url'] = site_url('store/index/page');
        $config['total_rows'] = $total_row;
        $config['per_page'] = 10;
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li><a>';
        $config['first_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_url'] = '1';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
        $products = $this->Product_model->find($config["per_page"], $page, $where);

        $this->load->view('templates/store', array(
            'title' => 'Home',
            'templatePage' => 'store/index',
            'logged_in' => $this->session->userdata('logged_in'),
            'products' => $products,
            'links' => $this->pagination->create_links(),
            'flashMessage' => $this->session->flashdata('message')
        ));
    }
}