<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="narrow">
    <h1>Login</h1>
    <form action="<?= site_url('login') ?>" method="post" class="card form" novalidate>
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" autocomplete="username" autofocus
               value="<?= esc(old('username')) ?>">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="current-password">

        <div class="form-actions">
            <button type="submit" class="btn">Log in</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>