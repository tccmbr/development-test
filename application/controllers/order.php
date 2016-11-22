<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Order
 * @author Ewerton Oliveira
 */
class Order extends CI_Controller
{
    const REDIRECT_TO = 'store';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model','order');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') !== TRUE) redirect(self::REDIRECT_TO);

        $orders = $this->order->find();
        
        $this->load->view('templates/store', array(
            'title' => 'Pedidos',
            'templatePage' => 'order/index',
            'orders' => $orders
        ));
    }
}