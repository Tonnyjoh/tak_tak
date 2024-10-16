<?= $this->extend('Layouts/layout'); ?>

<?= $this->section('content'); ?>

<style>
    .highlight-btn {
        background-color: #2e4b9c;
        border-color: #2e4b9c;
        color: #fff;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .highlight-btn:hover {
        background-color: #2980b9;
    }

    .highlight-card {
        border: 1px solid #f0f0f0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }

    .highlight-card:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .highlight-image {
        border-bottom: 4px solid #2e4b9c;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .highlight-image:hover {
        transform: scale(1.03);
    }

    .highlight-title {
        color: #2c3e50;
        font-weight: 600;
    }

    .highlight-price {
        color: #e74c3c;
        font-weight: bold;
    }

    .search-container {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .btn-secondary {
        background-color: #95a5a6;
    }

    .modal-title {
        color: #2e4b9c;
    }

    .form-select, .form-control {
        border-radius: 6px;
    }

    .modal-dialog {
        max-width: 500px;
    }
</style>

<div class="container-list-item mt-4">
    <h2 class="text-center mb-4">Available Items for Exchange</h2>
    <!-- Search Form -->
    <form action="<?= site_url('item/filterListItems') ?>" method="post" class="search-container">
        <div class="row">
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">-- All Categories --</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= esc($category['id']) ?>" <?= set_select('category', 'category1', $category == $category['name']) ?>>
                            <?= esc($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" name="keywords" class="form-control" placeholder="Enter keywords" value="">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn highlight-btn w-100">Search</button>
            </div>
        </div>
    </form>

    <!-- Item Cards -->
    <?php if (!empty($items) && is_array($items)): ?>
        <div class="row">
            <?php foreach ($items as $item): ?>
                <div class="col-md-3 mb-4">
                    <div class="card highlight-card">
                        <?php if (!empty($item->photos)): ?>
                            <?php $photos = explode(',', $item->photos); $mainPhoto = $photos[0]; ?>
                            <img src="<?= base_url('uploads/' . $mainPhoto) ?>" class="card-img-top highlight-image img-fluid" alt="<?= esc($item->title) ?>" style="height: 250px;">
                        <?php else: ?>
                            <img src="<?= base_url('uploads/default.png') ?>" class="card-img-top highlight-image img-fluid" alt="No image available" style="height: 250px;">
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title highlight-title"><?= esc($item->title) ?></h5>
                            <p class="card-text"><?= esc($item->description) ?></p>
                            <p class="card-text"><span class="highlight-price">Price:</span> <?= esc($item->estimated_price) ?> Ar</p>

                            <button type="button" class="btn highlight-btn" data-bs-toggle="modal" data-bs-target="#exchangeModal" data-item-id="<?= esc($item->id) ?>">
                                Propose an Exchange
                            </button>
                            <form method="post" action="<?= base_url('item/history') ?>">
                                <input name="item_id" type="hidden" value="<?= esc($item->id) ?>">
                                <button class="btn btn-secondary mt-2 w-100">View History</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No items available at the moment.</p>
    <?php endif; ?>
</div>

<!-- Exchange Modal -->
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
                    <button type="submit" class="btn highlight-btn">Submit Exchange</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Data Script -->
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
