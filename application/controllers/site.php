<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['page'] = 'index';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('site/index');
        $this->load->view('templates/footer');
    }

    public function contact()
    {
        $data['title'] = 'Contact';
        $data['page'] = 'contact';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('site/contact');
        $this->load->view('templates/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */