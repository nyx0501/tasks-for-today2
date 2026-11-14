<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $loggedIn = session()->get('isLoggedIn') === true; ?>
<div class="row-between">
    <h1>Task List</h1>
    <?php if ($loggedIn): ?>
        <a class="btn" href="<?= site_url('tasks/new') ?>">+ New Task</a>
    <?php endif; ?>
</div>
<p class="muted">All tasks, ordered by date.<?= $loggedIn ? '' : ' <a href="' . site_url('login') . '">Log in</a> to add, edit or delete tasks.' ?></p>

<?php if (empty($tasks)): ?>
    <div class="card empty">No tasks yet.</div>
<?php else: ?>
    <div class="card flush">
        <?= view('tasks/_table', ['tasks' => $tasks, 'showActions' => $loggedIn]) ?>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>