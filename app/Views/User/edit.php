<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="card">
        <h2 class="text-center card-title">Update User</h2>

        <?php echo \Config\Services::validation()->listErrors(); ?>

        <form action="<?= site_url('user/update/') ?>" method="post" class="form mt-4">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" />
            </div>

            <button type="submit" class="button frm btn-modifier btn-block mt-3">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>