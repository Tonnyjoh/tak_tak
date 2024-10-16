<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="text-prima mb-4"><strong><span class="prima">Create</span> Category</strong></h3>
        <?= \Config\Services::validation()->listErrors(); ?>
        <form action="<?= site_url('admin/createCateg/') ?>" method="post" class="row g-3">
            <?= csrf_field() ?>

            <div class="col-md-12">
                <label for="name" class="form-label">Category Name:</label>
                <input required type="text" id="name" class="form-control" name="name" placeholder="Enter category name" />
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-3">Create</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
