<?php

class Migration_Add_order extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'order_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'order_code' => array(
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => TRUE
            ),
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),
            'product_quantity' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            )
        ));
        
        $this->dbforge->add_key("order_id",TRUE);
        $this->dbforge->create_table('orders');
        $this->db->query(
            'ALTER TABLE orders ADD CONSTRAINT fk_product_id FOREIGN KEY (product_id) REFERENCES products(product_id)
             ON DELETE CASCADE'
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('orders');
    }
}