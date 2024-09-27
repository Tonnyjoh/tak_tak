<?= $this->extend('Layouts/layout'); ?>

<?= $this->section('content'); ?>

<div class="">
    <h2 class="text-center mb-4">Items with price within <?= esc($percent) ?>% of the selected item</h2>

    <?php if (!empty($items) && is_array($items)): ?>
        <div class="row">
            <?php foreach ($items as $item):
                $itemPrice = $item['estimated_price'];
                $priceDifference = (($itemPrice - $referencePrice) / $referencePrice) * 100;
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($item['title']) ?></h5>
                            <p class="card-text"><?= esc($item['description']) ?></p>
                            <p class="card-text"><strong>Price: </strong><?= esc($item['estimated_price']) ?> Ar</p>
                            <p class="card-text"><strong>Difference: </strong><?= number_format($priceDifference, 0) ?>%</p>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exchangeModal" data-item-id="<?= esc($item['id']) ?>">
                                Propose an Exchange
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No items found within this price range.</p>
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
