<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container">
        <div class="card">
            <h2 class="text-center card-title">Create Item</h2>

            <form action="<?= site_url('item/create') ?>" method="post" enctype="multipart/form-data" class="form mt-4">
                <input type="hidden" class="form-control" name="user_id" value="<?= session()->get('user_id') ?>" />

                <div class="form-group">
                    <label for="category_id">Choose a category:</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?= $categorie['id']?>"><?= $categorie['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title"  required />
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" class="form-control" name="description"/>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" min="0" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="files">Choose files:</label>
                    <input type="file" name="files[]" class="form-control" id="files" multiple>
                </div>
                <button type="submit" class="button frm btn-modifier btn-block mt-3">Create</button>
            </form>
        </div>
    </div>

<?= $this->endSection() ?>