<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <?php if (session()->get("role") == 'client'): ?>
        <div id="sectionone">
            <div class="card">
                <h2 class="card-title">Items</h2>
                <?php if (!empty($items) && is_array($items)): ?>
                    <table class="data-table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= esc($item->title) ?></td>
                                <td><?= esc($item->description) ?></td>
                                <td><?= esc($item->estimated_price) ?></td>
                                <td>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#itemModal-<?= esc($item->id) ?>">
                                        See
                                    </button>
                                    <a href="<?= site_url('item/update/'.$item->id) ?>" class="btn btn-secondary">Update</a>
                                    <a href="<?= site_url('item/delete/'.$item->id); ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-secondary">Delete</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="itemModal-<?= esc($item->id) ?>" tabindex="-1" aria-labelledby="itemModalLabel-<?= esc($item->id) ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="itemModalLabel-<?= esc($item->id) ?>"><?= esc($item->title) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Description:</strong> <?= esc($item->description) ?></p>
                                            <p><strong>Price:</strong> <?= esc($item->estimated_price) ?></p>

                                            <?php
                                            // Explode the photos string to get an array of photo URLs
                                            $photos = explode(',', $item->photos);
                                            foreach ($photos as $photo): ?>
                                                <img src="<?= base_url('uploads/'.$photo) ?>" class="img-fluid" alt="Item photo">
                                            <?php endforeach; ?>
                                        </div>

                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <a href="<?= site_url('/item/create') ?>" class="btn btn-primary">Create an Item</a>

            </div>
        </div>
        <!-- Personal Information Section -->
        <div class="card info-card">
            <h2 class="card-title">Personal Information</h2>
            <p><strong>Name:</strong> <?= esc($user['username']) ?></p>
            <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
            <a href="<?= site_url('user/edit/'); ?>" class="btn btn-secondary">Edit</a>
        </div>

    <?php else: ?>
        <!-- User List for Admin -->
        <div class="containeradmin">
            <a href="<?= base_url('/admin/getFormCateg')?>">Create category</a>

            <div id="sectionone" class="card">
                <h2 class="text-center card-title">User List</h2>
                <table class="data-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($users) && is_array($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= esc($user->id) ?></td>
                                <td><?= esc($user->username) ?></td>
                                <td><?= esc($user->email) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/edit/' . $user->id); ?>" class="btn btn-secondary">Edit</a>
                                    <a href="<?= site_url('admin/delete/' . $user->id); ?>" class="btn btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>
</div>

<?= $this->endSection() ?>
