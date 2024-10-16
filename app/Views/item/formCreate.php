<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="text-prima mb-4"><strong><span class="prima">Create</span> Item</strong></h3>

        <form action="<?= site_url('item/create') ?>" method="post" enctype="multipart/form-data" class="row g-3">
            <input type="hidden" class="form-control" name="user_id" value="<?= session()->get('user_id') ?>" />

            <div class="col-md-6">
                <label for="category_id" class="form-label">Choose a category:</label>
                <select id="category_id" name="category_id" class="form-select">
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie['id']?>"><?= $categorie['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" required />
            </div>

            <div class="col-md-12">
                <label for="description" class="form-label">Description:</label>
                <input type="text" id="description" class="form-control" name="description"/>
            </div>

            <div class="col-md-6">
                <label for="price" class="form-label">Price:</label>
                <input type="number" id="price" name="price" min="0" class="form-control" required />
            </div>

            <div class="col-md-6">
                <label for="files" class="form-label">Choose files:</label>
                <input type="file" name="files[]" class="form-control" id="files" multiple>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-3">Create</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
