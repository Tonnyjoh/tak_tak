<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="text-prima mb-4"><strong><span class="prima">Edit</span> User</strong></h3>

        <?= \Config\Services::validation()->listErrors(); ?>

        <form action="<?= site_url('admin/update/' . $user['id']) ?>" method="post" class="row g-3">
            <?= csrf_field() ?>

            <div class="col-md-12">
                <label for="username" class="form-label">Name:</label>
                <input type="text" id="username" class="form-control" name="username"
                       value="<?= esc($user['username']); ?>" placeholder="Username" required />
            </div>

            <div class="col-md-12">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" class="form-control" name="email"
                       value="<?= esc($user['email']); ?>" placeholder="Email Address" required />
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
