<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <?php if (session()->get("role") == 'client'): ?>
        <!-- Items Section -->
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
                                    <form method="post" action="<?= site_url('item/update/') ?>">
                                        <input type="hidden" value="<?= $item->id ?>" name="item_id">
                                        <button type="submit" class="btn btn-secondary">Update</button>
                                    </form>
                                    <a href="<?= site_url('item/delete/'.$item->id); ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-secondary">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <a href="<?= site_url('/item/create') ?>" class="btn btn-primary">Create an Item</a>
            </div>
        </div>

        <!-- Exchange Requests Section -->
        <div class="card">
            <h2 class="card-title">Exchange Requests</h2>
            <?php if (!empty($exchanges) && is_array($exchanges)): ?>
                <table class="data-table">
                    <thead>
                    <tr>
                        <th>Offered Item</th>
                        <th>Requested Item</th>
                        <th>Owner of Requested Item</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($exchanges as $exchange): ?>
                        <tr>
                            <td><?= esc($exchange->offered_item_title) ?></td>
                            <td><?= esc($exchange->requested_item_title) ?></td>
                            <td><?= esc($exchange->owner_name) ?></td>
                            <td><?= esc($exchange->exchange_date) ?></td>
                            <td><?= esc($exchange->status) ?></td>
                            <td>
                                <?php if ($exchange->status == 'proposed'): ?>
                                    <form method="post" action="<?= site_url('exchange/accept') ?>">
                                        <input type="hidden" name="exchange_id" value="<?= $exchange->id ?>">
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>
                                    <form method="post" action="<?= site_url('exchange/decline') ?>">
                                        <input type="hidden" name="exchange_id" value="<?= $exchange->id ?>">
                                        <button type="submit" class="btn btn-danger">Decline</button>
                                    </form>
                                <?php else: ?>
                                    <span class="badge <?= $exchange->status == 'accepted' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= ucfirst($exchange->status) ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No exchange requests found.</p>
            <?php endif; ?>
        </div>

        <!-- Personal Information Section -->
        <div class="card info-card">
            <h2 class="card-title">Personal Information</h2>
            <p><strong>Name:</strong> <?= esc($user['username']) ?></p>
            <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
            <a href="<?= site_url('user/edit/'); ?>" class="btn btn-secondary">Edit</a>
        </div>

    <?php else: ?>
        <!-- Admin Section for Managing Users -->
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
