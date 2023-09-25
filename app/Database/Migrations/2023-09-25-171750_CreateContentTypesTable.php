<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContentTypesTable extends Migration
{
    public function up()
    {
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'unique' => true,
			]
		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->addUniqueKey('name');
		$this->forge->createTable('content_types');
    }

    public function down()
    {
        $this->forge->dropTable('content_types');
    }
}
