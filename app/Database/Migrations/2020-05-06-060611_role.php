<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'role_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'role_name' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'status' => [
				'type' => 'CHAR',
				'constraint' => 1
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => TRUE,
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
			'deleted_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			]
		]);

		$this->forge->addKey('role_id', TRUE);
		$this->forge->createTable('role');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('role');
	}
}
