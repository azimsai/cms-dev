<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Drop_all extends CI_Migration {

	public function up()
	{
		$this->dbforge->drop_table('users');
		$this->dbforge->drop_table('ci_sessions');
		$this->dbforge->drop_table('pages');
	}

	public function down()
	{
		
	}
}