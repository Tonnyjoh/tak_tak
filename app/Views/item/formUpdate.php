<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="text-prima mb-4"><strong><span class="prima">Update</span> Item</strong></h3>


        <?php echo \Config\Services::validation()->listErrors(); ?>

        <form action="<?= site_url('item/update/') ?>" method="post" enctype="multipart/form-data" class="row g-3">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">

            <div class="col-md-12">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" class="form-control" name="title"
                       value="<?= esc($item['title']) ?>" placeholder="Title" />
            </div>

            <div class="col-md-12">
                <label for="description" class="form-label">Description:</label>
                <input type="text" id="description" class="form-control" name="description"
                       value="<?= esc($item['description']) ?>" />
            </div>

            <div class="col-md-6">
                <label for="estimated_price" class="form-label">Price:</label>
                <input type="number" id="estimated_price" class="form-control" name="estimated_price" min="0"
                       value="<?= esc($item['estimated_price']) ?>" />
            </div>

            <div class="col-md-6">
                <label for="photos" class="form-label">Upload Photos:</label>
                <input type="file" id="photos" class="form-control" name="files[]" multiple>
                <small class="form-text text-muted">You can upload multiple photos (JPG, JPEG, PNG).</small>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
