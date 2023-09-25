<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateUserTable extends Migration {
	public function up() {
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'unique' => true,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'created_at' => [
				'type' => 'TIMESTAMP',
				'default' => new RawSql('CURRENT_TIMESTAMP'),
			],
			'updated_at' => [
				'type' => 'TIMESTAMP',
				'default' => new RawSql('CURRENT_TIMESTAMP'),
			],

		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->addUniqueKey('username');
		$this->forge->createTable('users');
	}

	public function down() {
		$this->forge->dropTable('users');
	}
}
