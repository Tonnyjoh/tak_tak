<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <?php if (session()->get("role") == 'client'): ?>
        <div id="sectionone" class="mb-4">
            <div class="card shadow">
                <h2 class="card-title text-center">Items</h2>
                <?php if (!empty($items) && is_array($items)): ?>
                    <table class="table table-striped table-bordered">
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
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#itemModal-<?= esc($item->id) ?>">
                                        See
                                    </button>
                                    <form method="post" action="<?= site_url('item/getFormUpdate/') ?>" class="d-inline">
                                        <input type="hidden" value="<?= $item->id ?>" name="item_id">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </form>
                                    <a href="<?= site_url('item/delete/'.$item->id); ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</a>
                                    <form action="<?= site_url('item/searchPercent/') ?>" method="post" class="d-inline-block">
                                        <input type="hidden" value="<?= $item->id ?>" name="item_id">
                                        <label for="percent" class="form-label">Select percentage range:</label>
                                        <select name="percent" id="percent" class="form-select d-inline-block w-auto">
                                            <option value="10">10%</option>
                                            <option value="20">20%</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal for Item Details -->
                            <div class="modal fade" id="itemModal-<?= esc($item->id) ?>" tabindex="-1" aria-labelledby="itemModalLabel-<?= esc($item->id) ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="itemModalLabel-<?= esc($item->id) ?>"><?= esc($item->title) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Description:</strong> <?= esc($item->description) ?></p>
                                            <p><strong>Price:</strong> <?= esc($item->estimated_price) ?></p>
                                            <?php
                                            $photos = explode(',', $item->photos);
                                            foreach ($photos as $photo): ?>
                                                <img src="<?= base_url('uploads/'.$photo) ?>" class="img-fluid mb-2" alt="Item photo">
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal for Item Details -->
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">No items available.</p>
                <?php endif; ?>
                <a href="<?= site_url('/item/create') ?>" class="btn btn-primary mt-3">Create an Item</a>
            </div>
        </div>

        <!-- Exchange Requests Section -->
        <div class="card shadow mb-4">
            <h2 class="card-title text-center">Exchange requests</h2>
            <?php if (!empty($exchanges) && is_array($exchanges)): ?>
                <table class="table table-striped table-bordered">
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
                            <td><?= esc($exchange->recipient_name) ?></td>
                            <td><?= esc($exchange->exchange_date) ?></td>
                            <td><?= esc($exchange->status) ?></td>
                            <td>
                                <?php if ($exchange->status === 'accepted'): ?>
                                    <span class="text-success">Already Accepted</span>
                                <?php else: ?>
                                    <?php if ($exchange->requester_name === $user['username']): ?>
                                        <span class="text-warning">Request sent</span>
                                    <?php else: ?>
                                        <a href="<?= site_url('exchange/accept/'.$exchange->id); ?>" class="btn btn-secondary">Accept</a>
                                    <?php endif; ?>
                                    <a href="<?= site_url('exchange/decline/'.$exchange->id); ?>" class="btn btn-danger"><?php
                                        if ($exchange->requester_name === $user['username']){
                                            echo "Cancel";
                                        } else {
                                            echo "Decline";
                                        }
                                        ?></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No exchange requests found.</p>
            <?php endif; ?>
        </div>

        <!-- Personal Information Section -->
        <div class="card info-card shadow mb-4">
            <h2 class="card-title text-center">Personal Information</h2>
            <p><strong>Name:</strong> <?= esc($user['username']) ?></p>
            <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
            <a href="<?= site_url('user/edit/'); ?>" class="btn btn-secondary">Edit</a>
        </div>

    <?php else: ?>
        <!-- User List for Admin -->
        <div class="containeradmin mb-4">
            <a href="<?= base_url('/admin/getFormCateg') ?>" class="btn btn-primary mb-3">Create category</a>

            <div id="sectionone" class="card shadow">
                <h2 class="text-center card-title">User List</h2>
                <table class="table table-striped table-bordered">
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
            <div class="container">
                <div class="statistics mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h2 class="card-title">Dashboard Statistics</h2>
                            <p><strong>Total Non-Admin Users:</strong> <?= esc($user_count) ?></p>
                            <p><strong>Total Registered Users:</strong> <?= esc($statistics[0]->user_count) ?></p>
                            <p><strong>Total Exchanges Conducted:</strong> <?= esc($statistics[0]->exchange_count) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>

<?= $this->endSection() ?>
