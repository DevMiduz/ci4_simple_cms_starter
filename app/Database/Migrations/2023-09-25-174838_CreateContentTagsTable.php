<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContentTagsTable extends Migration
{
    public function up()
    {
		$this->forge->addField([
			'content_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
                'null' => false,
			],
			'tag_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
                'null' => false,
			],
		]);

		$this->forge->addPrimaryKey(['content_id', 'tag_id']);
        $this->forge->addForeignKey('content_id', 'content', 'id');
        $this->forge->addForeignKey('tag_id', 'tags', 'id');
		$this->forge->createTable('content_tags');
    }

    public function down()
    {
        $this->forge->dropTable('content_tags');
    }
}
