<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => false, 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'full_name'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => false],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('users', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('users', true);
    }
}