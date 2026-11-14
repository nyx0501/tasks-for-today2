<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->db->table('users')->countAllResults() > 0) {
            return;
        }
        $this->db->table('users')->insert([
            'username'   => 'demo',
            'full_name'  => 'Demo User',
            'email'      => 'demo@example.com',
            'password'   => password_hash('Demo@12345', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}