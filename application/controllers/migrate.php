<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Migrate
 * @author Ewerton Oliveira
 */
class Migrate extends CI_Controller
{
    /**
     * Migrate constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->input->is_cli_request() or exit("Execute via command line: php index.php migrate");

        $this->load->library('migration');
    }

    public function current()
    {
        if($this->input->is_cli_request()) {
            $migration = $this->migration->current();
            if(!$migration) {
                echo $this->migration->error_string();
            } else {
                echo 'Migration(s) done'.PHP_EOL;
            }
        } else {
            show_error('You don\'t have permission for this action');;
        }
    }

    public function latest()
    {
        if($this->input->is_cli_request()) {
            $migration = $this->migration->latest();
            if(!$migration) {
                echo $this->migration->error_string();
            } else {
                echo 'Migration(s) done'.PHP_EOL;
            }
        } else {
            show_error('You don\'t have permission for this action');;
        }
    }

    public function version($version)
    {
        if($this->input->is_cli_request()) {
            $migration = $this->migration->version($version);
            if(!$migration) {
                echo $this->migration->error_string();
            } else {
                echo 'Migration(s) done'.PHP_EOL;
            }
        } else {
            show_error('You don\'t have permission for this action');;
        }
    }
}