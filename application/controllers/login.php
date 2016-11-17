<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    const REDIRECT_TO = 'site';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User');
    }

    public function authentication()
    {
        $user = $this->User->get(['username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))]);

        if (count($user) > 0) {
            foreach ($user as $data) {
                $this->session->set_userdata(array(
                    'username'  => $data->username,
                    'logged_in' => TRUE
                ));
            }
        }
        
        redirect(self::REDIRECT_TO);
    }

    public function logout()
    {
        $this->session->unset_userdata(array(
            'username' => '',
            'logged_in' => ''
        ));

        redirect(self::REDIRECT_TO);
    }
}