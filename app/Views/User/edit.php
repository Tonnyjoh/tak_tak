<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="text-prima mb-4"><strong><span class="prima">Update</span> User</strong></h3>

        <?= \Config\Services::validation()->listErrors(); ?>

        <form action="<?= site_url('user/update/') ?>" method="post" class="row g-3">
            <?= csrf_field() ?>

            <div class="col-md-12">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?= esc($user['email']); ?>" placeholder="Enter your email" required />
            </div>

            <div class="col-md-12">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter a new password" />
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
