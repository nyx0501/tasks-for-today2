<?php $loggedIn = session()->get('isLoggedIn') === true; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Tasks for Today') ?> · Tasks for Today</title>
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
<header class="topbar">
    <div class="wrap bar">
        <a class="brand" href="<?= site_url('/') ?>">✔ Tasks for Today</a>
        <nav>
            <a href="<?= site_url('/') ?>">Welcome</a>
            <a href="<?= site_url('tasks') ?>">Task List</a>
            <a href="<?= site_url('profile') ?>">Profile</a>
            <a href="<?= site_url('about') ?>">About</a>
        </nav>
        <div class="auth">
            <?php if ($loggedIn): ?>
                <span class="who">Hi, <?= esc(session()->get('fullName')) ?></span>
                <form action="<?= site_url('logout') ?>" method="post" class="inline">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-ghost">Logout</button>
                </form>
            <?php else: ?>
                <a class="btn btn-ghost" href="<?= site_url('login') ?>">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main class="wrap">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-error">
            <strong>Please fix the following:</strong>
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</main>

<footer class="wrap foot">Tasks for Today Management System · IT0049 TSA2 · Built with CodeIgniter <?= \CodeIgniter\CodeIgniter::CI_VERSION ?></footer>
</body>
</html>