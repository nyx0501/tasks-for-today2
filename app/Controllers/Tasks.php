<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class Tasks extends BaseController
{
    private TaskModel $tasks;

    public function __construct()
    {
        $this->tasks = new TaskModel();
    }

    public function index(): string
    {
        return view('tasks/index', [
            'title' => 'Task List',
            'tasks' => $this->tasks->getAllActive(),
        ]);
    }

    public function new(): string
    {
        return view('tasks/form', [
            'title'  => 'New Task',
            'action' => site_url('tasks/create'),
            'task'   => ['title' => '', 'task_date' => date('Y-m-d'), 'status' => 'pending'],
        ]);
    }

    public function create(): RedirectResponse
    {
        if (! $this->tasks->insert($this->collectInput())) {
            return redirect()->back()->withInput()->with('errors', $this->tasks->errors());
        }

        return redirect()->to('/tasks')->with('success', 'Task created.');
    }

    public function edit(int $id): string
    {
        return view('tasks/form', [
            'title'  => 'Edit Task',
            'action' => site_url("tasks/{$id}/update"),
            'task'   => $this->findOr404($id),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->findOr404($id);

        if (! $this->tasks->update($id, $this->collectInput())) {
            return redirect()->back()->withInput()->with('errors', $this->tasks->errors());
        }

        return redirect()->to('/tasks')->with('success', 'Task updated.');
    }

    /** "Delete" = soft delete (is_archived = 1). */
    public function delete(int $id): RedirectResponse
    {
        $this->findOr404($id);
        $this->tasks->archive($id);

        return redirect()->to('/tasks')->with('success', 'Task deleted.');
    }

    private function collectInput(): array
    {
        return [
            'title'     => trim((string) $this->request->getPost('title')),
            'task_date' => trim((string) $this->request->getPost('task_date')),
            'status'    => (string) ($this->request->getPost('status') ?: 'pending'),
        ];
    }

    private function findOr404(int $id): array
    {
        $task = $this->tasks->findActive($id);

        if ($task === null) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        return $task;
    }
}