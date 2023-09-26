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
			'title' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'unique' => true,
			]
		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->addUniqueKey('title');
		$this->forge->createTable('content_types');
    }

    public function down()
    {
        $this->forge->dropTable('content_types');
    }
}
