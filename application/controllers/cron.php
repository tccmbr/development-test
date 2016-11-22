<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controle Informática
 *
 * @copyright 2012-2016 (http://controleinfo.com.br)
 */
class Cron extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->input->is_cli_request() or exit("Execute via command line: php index.php cron");
        $this->load->model('Order_model','order');
    }

    public function index()
    {
        echo shell_exec('crontab -l > cronstore');
        echo shell_exec('echo "0,30 * * * * php '.BASEPATH.'../index.php cron createOrder" >> cronstore');
        echo shell_exec('crontab cronstore');
        echo shell_exec('rm cronstore');
    }

    public function createOrder()
    {
        delete_files(APPPATH . 'cache/');

        $products = $this->Product_model->findRandom();

        $data = array();
        $code = rand(100000000,999999999);

        foreach ($products as $product) {
            $quantity = rand(1, 5);
            if ($product->product_stock_quantity >= $quantity) {
                $data[] = array(
                    'order_code' => $code,
                    'product_id' => $product->product_id,
                    'product_quantity' => $quantity
                );

                $product->product_stock_quantity = $product->product_stock_quantity - $quantity;
                $this->Product_model->update($product);
            }
        }

        if (count($data) > 0) $this->order->insert($data);
    }
}