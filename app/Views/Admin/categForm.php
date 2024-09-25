<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container">
        <div class="card">
            <h2 class="text-center card-title">Create category</h2>

            <?php echo \Config\Services::validation()->listErrors(); ?>

            <form action="<?= site_url('admin/createCateg/') ?>" method="post" class="form mt-4">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">Category</label>
                    <input required type="text" id="name" class="form-control" name="name"/>
                </div>

                <button type="submit" class="button frm btn-modifier btn-block mt-3">Create</button>
            </form>
        </div>
    </div>

<?= $this->endSection() ?>