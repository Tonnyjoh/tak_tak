<?= $this->extend('Layouts/layout'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">History for the item:<span class="text-prima"> <?= esc($item['title']) ?></span></h2>

    <?php if (!empty($history)) : ?>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                <tr>
                    <th>Exchange date</th>
                    <th>Previous owner</th>
                    <th>New owner</th>
                    <th></th> <!-- Empty column for the arrow -->
                </tr>
                </thead>
                <tbody>
                <?php foreach ($history as $entry): ?>
                    <tr>
                        <td><?= esc($entry['exchange_date']) ?></td>
                        <td><?= esc($entry['previous_owner']) ?></td>
                        <td><?= esc($entry['new_owner']) ?></td>
                        <td class="text-end">
                            <a href="#" class="arrow-icon">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Nothing to see.</p>
    <?php endif; ?>
</div>

<style>
    /* Styling for the table */
    .custom-table {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-table thead {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .custom-table th {
        padding: 15px;
        font-weight: bold;
        text-align: left;
        color: #333;
    }

    .custom-table td {
        padding: 15px;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
    }

    .arrow-icon {
        text-decoration: none;
        color: #6c757d;
    }

    .arrow-icon:hover {
        color: #007bff;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
    }
</style>

<?= $this->endSection(); ?>
