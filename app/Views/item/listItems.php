<?= $this->extend('Layouts/layout'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Available Items for Exchange</h2>

    <form action="<?= site_url('item/filterListItems') ?>" method="post" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">-- All Categories --</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?=$category['id'] ?>" <?= set_select('category', 'category1', $category == $category['name'] ) ?>><?=$category['name'] ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" name="keywords" class="form-control" placeholder="Enter keywords" value="">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    <!-- Liste des articles -->
    <?php if (!empty($items) && is_array($items)): ?>
        <div class="row">
            <?php foreach ($items as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <?php if (!empty($item->photos)): ?>
                            <?php
                            $photos = explode(',', $item->photos);
                            $mainPhoto = $photos[0];
                            ?>
                            <img src="<?= base_url('uploads/' . $mainPhoto) ?>" class="card-img-top img-fluid" alt="<?= esc($item->title) ?>" style="height: 250px; object-fit: cover;">
                        <?php else: ?>
                            <img src="<?= base_url('uploads/default.png') ?>" class="card-img-top img-fluid" alt="No image available" style="height: 250px; object-fit: cover;">
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?= esc($item->title) ?></h5>
                            <p class="card-text"><?= esc($item->description) ?></p>
                            <p class="card-text"><strong>Price: </strong><?= esc($item->estimated_price) ?> Ar</p>

                            <!-- Bouton pour ouvrir le modal d'échange -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exchangeModal" data-item-id="<?= $item->id ?>">
                                Propose an Exchange
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No items available at the moment.</p>
    <?php endif; ?>
</div>

<!-- Modal d'échange -->
<div class="modal fade" id="exchangeModal" tabindex="-1" aria-labelledby="exchangeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exchangeModalLabel">Propose an Exchange</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('item/exchange') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="requested_item_id" id="requestedItemId">
                    <div class="mb-3">
                        <label for="offered_item" class="form-label">Select your item to exchange:</label>
                        <select class="form-select" name="offered_item_id" id="offered_item" required>
                            <option value="">-- Select an Item --</option>
                            <?php foreach ($userItems as $userItem): ?>
                                <option value="<?= esc($userItem->id) ?>"><?= esc($userItem->title) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message (Optional):</label>
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit Exchange</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const exchangeModal = document.getElementById('exchangeModal');
    exchangeModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const itemId = button.getAttribute('data-item-id');

        const modalInput = exchangeModal.querySelector('#requestedItemId');
        modalInput.value = itemId;
    });
</script>

<?= $this->endSection(); ?>
