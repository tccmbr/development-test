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
    }

    public function index()
    {
        delete_files(APPPATH . 'cache/');
        shell_exec('php index.php store');
    }
}