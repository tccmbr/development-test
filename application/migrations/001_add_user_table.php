<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Migration_Add_user_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ),
            'state' => array(
                'type' => 'BOOLEAN',
                'default' => 1
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false,
                'default' => 'admin'
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => false,
                'default' => md5('123456')
            )
        ));

        $this->dbforge->add_key('user_id', true);
        $this->dbforge->create_table('user');
    }

    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}