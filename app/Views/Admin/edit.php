<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="card">
        <h2 class="text-center card-title">Edit User</h2>

        <?php echo \Config\Services::validation()->listErrors(); ?>

        <form action="<?= site_url('admin/update/' . $user['id']) ?>" method="post" class="form mt-4">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="username">Name</label>
                <input type="text" id="username" class="form-control" name="username"
                    value="<?php echo esc($user['username']); ?>" placeholder="Username" />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email"
                    value="<?php echo esc($user['email']); ?>" placeholder="Email Address" />
            </div>

            <button type="submit" class="button frm btn-modifier btn-block mt-3">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>