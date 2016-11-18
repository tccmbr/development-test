<?php

class Migration_Add_product extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'product_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'product_price' => array(
                'type' => 'decimal',
                'constraint' => '10,2',
            ),
            'product_stock_quantity' => array(
                'type' => 'INT',
                'constraint' => '4',
            ),
        ));
        
        $this->dbforge->add_key("product_id",TRUE);
        $this->dbforge->create_table('products');
    }

    public function down()
    {
        $this->dbforge->drop_table('products');
    }
}