<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1>Profile</h1>
<?php if ($user === null): ?>
    <div class="card empty">No user record found. Run <code>php spark db:seed DatabaseSeeder</code>.</div>
<?php else: ?>
    <div class="card">
        <dl class="details">
            <dt>Full name</dt><dd><?= esc($user['full_name']) ?></dd>
            <dt>Username</dt><dd><?= esc($user['username']) ?></dd>
            <dt>Email</dt><dd><?= esc($user['email']) ?></dd>
            <dt>Member since</dt><dd><?= esc(date('F j, Y', strtotime($user['created_at']))) ?></dd>
        </dl>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>