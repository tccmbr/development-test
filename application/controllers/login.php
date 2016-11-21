<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Login
 * @author Ewerton Oliveira
 */
class Login extends CI_Controller
{
    const REDIRECT_TO = 'store';

    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function authentication()
    {
        $user = $this->user->get(['username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))]);

        if (count($user) > 0) {
            foreach ($user as $data) {
                $this->session->set_userdata(array(
                    'username'  => $data->username,
                    'logged_in' => TRUE
                ));
            }
        }

        delete_files(APPPATH.'cache');
        redirect(self::REDIRECT_TO);
    }

    public function logout()
    {
        delete_files(APPPATH.'cache');
        $this->session->sess_destroy();
        redirect(self::REDIRECT_TO);
    }
}