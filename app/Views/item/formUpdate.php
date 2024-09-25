<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="card">
        <h2 class="text-center card-title">Edit Item</h2>

        <?php echo \Config\Services::validation()->listErrors(); ?>

        <form action="<?= site_url('item/update/') ?>" method="post" enctype="multipart/form-data" class="form mt-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" class="form-control" name="title"
                       value="<?= esc($item['title']) ?>" placeholder="Title" />
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" class="form-control" name="description"
                       value="<?= esc($item['description']) ?>" />
            </div>

            <div class="form-group">
                <label for="estimated_price">Price:</label>
                <input type="number" id="estimated_price" class="form-control" name="estimated_price" min="0"
                       value="<?= esc($item['estimated_price']) ?>" />
            </div>

            <div class="form-group">
                <label for="photos">Upload Photos:</label>
                <input type="file" id="photos" class="form-control" name="files[]" multiple>
                <small class="form-text text-muted">You can upload multiple photos (JPG, JPEG, PNG).</small>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
