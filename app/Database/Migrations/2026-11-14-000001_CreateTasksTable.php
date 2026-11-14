<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasksTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => false, 'auto_increment' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => false],
            'status'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => false, 'default' => 'pending'],
            'task_date'  => ['type' => 'DATE', 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => false],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tasks', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('tasks', true);
    }
}