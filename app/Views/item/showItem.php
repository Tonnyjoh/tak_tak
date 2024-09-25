<?= $this->extend('Layouts/layout'); ?>
<?= $this->section('content'); ?>
    <div>
        <h2>Personal Information</h2>
        <p><strong>Name:</strong> <?= esc($item['title']) ?></p>
        <p><strong>Email:</strong> <?= esc($item['description']) ?></p>
    </div>
<?= $this->endSection() ?>
