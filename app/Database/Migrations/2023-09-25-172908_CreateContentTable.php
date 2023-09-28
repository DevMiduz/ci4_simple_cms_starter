<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateContentTable extends Migration
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
				'constraint' => '255',
				'unique' => true,
			],
			'slug' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'unique' => true,
			],
            'description' => [
				'type' => 'TEXT',
				'null' => false,
            ],
			'content_body' => [
				'type' => 'TEXT',
				'null' => false,
            ],
            'published' => [
				'type' => 'BOOL',
                'default' => 0,
				'null' => false,
			],
			'created_at' => [
				'type' => 'TIMESTAMP',
				'default' => new RawSql('CURRENT_TIMESTAMP'),
			],
			'updated_at' => [
				'type' => 'TIMESTAMP',
				'default' => new RawSql('CURRENT_TIMESTAMP'),
			],
            'content_type_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
                'null' => false,
			],
		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->addUniqueKey('title');
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('content_type_id', 'content_types', 'id');
		$this->forge->createTable('content');
    }

    public function down()
    {
        $this->forge->dropTable('content');
    }
}
