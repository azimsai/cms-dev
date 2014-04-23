<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_parent_id_to_pages extends CI_Migration {

	public function up()
	{
		$field = (array(
				'parent_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'default' => 0
			),
			
		));
		
		$this->dbforge->add_column('pages', $field);
	}

	public function down()
	{
		$this->dbforge->drop_table('pages', $field);
	}
}