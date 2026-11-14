<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsArchivedToTasks extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('tasks', [
            'is_archived' => ['type' => 'TINYINT', 'constraint' => 1, 'null' => false, 'default' => 0],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('tasks', 'is_archived');
    }
}