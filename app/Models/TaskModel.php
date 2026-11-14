<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table         = 'tasks';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['title', 'status', 'task_date', 'is_archived'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $dateFormat    = 'datetime';

    protected $validationRules = [
        'title'     => 'required|max_length[150]',
        'task_date' => 'required|valid_date[Y-m-d]',
        'status'    => 'permit_empty|in_list[pending,in_progress,completed]',
    ];
    protected $validationMessages = [
        'title' => [
            'required'   => 'Please enter a title for the task.',
            'max_length' => 'The title cannot be longer than 150 characters.',
        ],
        'task_date' => [
            'required'   => 'Please choose a date for the task.',
            'valid_date' => 'The date must be a valid date (YYYY-MM-DD).',
        ],
        'status' => [
            'in_list' => 'Status must be pending, in progress, or completed.',
        ],
    ];

    /** Welcome page: only today's tasks, archived excluded. */
    public function getToday(): array
    {
        return $this->where('task_date', date('Y-m-d'))
                    ->where('is_archived', 0)
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }

    /** Task List page: every non-archived task, ordered by date. */
    public function getAllActive(): array
    {
        return $this->where('is_archived', 0)
                    ->orderBy('task_date', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }

    public function findActive(int $id): ?array
    {
        return $this->where('is_archived', 0)->find($id);
    }

    /** Soft delete: flag the row instead of removing it. */
    public function archive(int $id): bool
    {
        return $this->update($id, ['is_archived' => 1]);
    }
}