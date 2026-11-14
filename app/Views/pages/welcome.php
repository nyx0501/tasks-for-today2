<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1>Tasks for Today</h1>
<p class="muted"><?= esc($today) ?></p>

<?php if (empty($tasks)): ?>
    <div class="card empty">Nothing scheduled for today. 🎉</div>
<?php else: ?>
    <div class="card flush">
        <?= view('tasks/_table', ['tasks' => $tasks, 'showActions' => false]) ?>
    </div>
<?php endif; ?>

<?php if (session()->get('isLoggedIn') === true): ?>
    <p><a class="btn" href="<?= site_url('tasks/new') ?>">+ New Task</a></p>
<?php endif; ?>
<?= $this->endSection() ?>