<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'user_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'fullname' => [
				'type' => 'VARCHAR',
				'constraint' => 191
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => 191,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 191 
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 191,
				'null' => TRUE,
			],
			'phone' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => TRUE,
			],
			'profile_picture' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'role_id' => [
				'type' => 'INT',
				'constraint' => 11
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

		$this->forge->addKey('user_id', TRUE);
		$this->forge->createTable('user');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
