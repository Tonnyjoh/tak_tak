<?= $this->extend('Layouts/layout'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">History for the item : <?= esc($item['title']) ?></h2>

    <?php if (!empty($history)) : ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Exchange date</th>
                <th>Previous owner</th>
                <th>New owner</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($history as $entry): ?>
                <tr>
                    <td><?= esc($entry['exchange_date']) ?></td>
                    <td><?= esc($entry['previous_owner']) ?></td>
                    <td><?= esc($entry['new_owner']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Nothing to see.</p>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
