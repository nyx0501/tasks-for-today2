<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php
$statuses = ['pending' => 'Pending', 'in_progress' => 'In progress', 'completed' => 'Completed'];
$errors   = session()->getFlashdata('errors') ?? [];
?>
<h1><?= esc($title) ?></h1>

<form action="<?= esc($action) ?>" method="post" class="card form" novalidate>
    <?= csrf_field() ?>

    <label for="title">Title <span class="req">*</span></label>
    <input type="text" id="title" name="title" maxlength="150"
           value="<?= esc(old('title', $task['title'])) ?>"
           class="<?= isset($errors['title']) ? 'invalid' : '' ?>">
    <?php if (isset($errors['title'])): ?><div class="field-error"><?= esc($errors['title']) ?></div><?php endif; ?>

    <label for="task_date">Date <span class="req">*</span></label>
    <input type="date" id="task_date" name="task_date"
           value="<?= esc(old('task_date', $task['task_date'])) ?>"
           class="<?= isset($errors['task_date']) ? 'invalid' : '' ?>">
    <?php if (isset($errors['task_date'])): ?><div class="field-error"><?= esc($errors['task_date']) ?></div><?php endif; ?>

    <label for="status">Status</label>
    <select id="status" name="status">
        <?php foreach ($statuses as $value => $label): ?>
            <option value="<?= $value ?>" <?= old('status', $task['status']) === $value ? 'selected' : '' ?>><?= $label ?></option>
        <?php endforeach; ?>
    </select>
    <?php if (isset($errors['status'])): ?><div class="field-error"><?= esc($errors['status']) ?></div><?php endif; ?>

    <div class="form-actions">
        <button type="submit" class="btn">Save</button>
        <a class="btn btn-ghost" href="<?= site_url('tasks') ?>">Cancel</a>
    </div>
</form>
<?= $this->endSection() ?>