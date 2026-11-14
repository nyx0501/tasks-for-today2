<?php
/** Expects: $tasks (array), $showActions (bool) */
$labels = ['pending' => 'Pending', 'in_progress' => 'In progress', 'completed' => 'Completed'];
?>
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Status</th>
            <?php if ($showActions): ?><th class="right">Actions</th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $t): ?>
        <tr>
            <td><?= esc($t['title']) ?></td>
            <td><?= esc(date('M j, Y', strtotime($t['task_date']))) ?></td>
            <td><span class="badge badge-<?= esc($t['status']) ?>"><?= esc($labels[$t['status']] ?? $t['status']) ?></span></td>
            <?php if ($showActions): ?>
                <td class="right actions">
                    <a class="btn btn-small" href="<?= site_url("tasks/{$t['id']}/edit") ?>">Edit</a>
                    <form action="<?= site_url("tasks/{$t['id']}/delete") ?>" method="post" class="inline"
                          onsubmit="return confirm('Delete this task?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-small btn-danger">Delete</button>
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>