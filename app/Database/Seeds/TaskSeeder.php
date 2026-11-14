<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->db->table('tasks')->countAllResults() > 0) {
            return;
        }
        $day = static fn (int $offset): string => date('Y-m-d', strtotime("{$offset} days"));
        $now = date('Y-m-d H:i:s');

        $rows = [
            ['Submit weekly progress report',            'completed',   $day(-1)],
            ['Review pull requests from the team',       'completed',   $day(-1)],
            ['Daily stand-up meeting at 9:00 AM',        'completed',   $day(0)],
            ['Fix login page validation bug',            'in_progress', $day(0)],
            ['Update the project documentation',         'pending',     $day(0)],
            ['Reply to client emails',                   'pending',     $day(0)],
            ['Prepare sprint demo slides',               'pending',     $day(1)],
            ['Database backup and maintenance check',    'pending',     $day(1)],
            ['Deploy version 1.2 to the hosting server', 'pending',     $day(3)],
            ['Sprint retrospective meeting',             'pending',     $day(3)],
        ];

        foreach ($rows as [$title, $status, $date]) {
            $this->db->table('tasks')->insert([
                'title'       => $title,
                'status'      => $status,
                'task_date'   => $date,
                'is_archived' => 0,
                'created_at'  => $now,
            ]);
        }
    }
}