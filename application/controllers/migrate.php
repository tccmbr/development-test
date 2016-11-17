<?php

class Migrate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->input->is_cli_request() or exit("Execute via command line: php index.php migrate");
        $this->load->library('migration');
    }

    public function index()
    {
        if($this->input->is_cli_request()) {
            if (!$this->migration->current()) {
                show_error($this->migration->error_string());
            } else {
                echo 'Migration(s) done'.PHP_EOL;
            }
        } else {
            show_error('You don\'t have permission for this action');
        }
    }

    public function version($version)
    {
        if($this->input->is_cli_request()) {
            if (!$this->migration->version($version)) {
                show_error($this->migration->error_string());
            } else {
                echo 'Migration(s) done'.PHP_EOL;
            }
        } else {
            show_error('You don\'t have permission for this action');
        }
    }
}