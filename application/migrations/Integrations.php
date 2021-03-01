<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Integrations extends CI_Migration
{
    /**
     * @var mixed
     */


    public function up()
    {
        $this->dbforge->add_field(array(
            'integration_id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'url' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('integrations_id', TRUE);
        $this->dbforge->create_table('integrations');
    }

    public function down()
    {
        $this->dbforge->drop_table('integrations');
    }

}