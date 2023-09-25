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
			'content_body' => [
				'type' => 'TEXT',
				'null' => false,
            ],
            'published' => [
				'type' => 'BOOLEAN',
                'default' => false,
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

/*
		$table = $this->table('content');

		$table->addColumn('title', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);
		$table->addColumn('slug', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);
		$table->addColumn('description', 'text', [
			'default' => null,
			'null' => false,
		]);
		$table->addColumn('body', 'text', [
			'default' => null,
			'null' => false,
		]);
		$table->addColumn('published', 'boolean', [
			'default' => false,
			'null' => false,
		]);
		$table->addColumn('created', 'datetime', [
			'default' => null,
			'null' => false,
		]);
		$table->addColumn('modified', 'datetime', [
			'default' => null,
			'null' => false,
		]);

		$table->addColumn('content_type_id', 'integer', [
			'default' => null,
			'null' => false,
		])->addForeignKey('content_type_id', 'content_types', 'id', array('delete' => 'SET_NULL', 'update' => 'NO_ACTION'));

		$table->addIndex('title', ['unique' => true]);
		$table->addIndex('slug', ['unique' => true]);

		$table->create();
*/