<?= $this->extend('Layouts/layout') ?>

<?= $this->section('content') ?>
<?php if (session()->get('role')== 'client'): ?>
    <!-- Profil dropdown -->
    <div class="dropdown" style="position: absolute; top: 10px; right: 10px;">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user"></i> Profil
        </button>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
            <p><span class="miavaka">Name:</span> <?= esc($user['username']) ?></p>
            <p><span class="miavaka">Email:</span> <?= esc($user['email']) ?></p>
            <li><a class="dropdown-item" href="<?= site_url('user/edit/'); ?>">Edit Profile</a></li>
        </ul>
    </div>
<?php endif; ?>

<div class="container position-relative bg-container">
    <?php if (session()->get("role") == 'client'): ?>
        <!-- Section des items -->
        <div id="sectionone" class="mb-4">
            <div>
                <?php if (!empty($items) && is_array($items)): ?>
                    <div class="items-container">
                        <h2>Items</h2>
                        <table class="absence-table">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td>
                                        <div class="employee">
                                            <?php
                                            $photos = explode(',', $item->photos);
                                            $firstPhoto = !empty($photos[0]) ? $photos[0] : '8399758.jpg';
                                            ?>
                                            <img src="<?= base_url('uploads/' . $firstPhoto) ?>" class="img-fluid" alt="<?= esc($item->title) ?>">
                                            <span class="capitalize"><?= esc($item->title) ?></span>
                                        </div>
                                    </td>
                                    <td><?= esc($item->description) ?></td>
                                    <td><?= esc($item->estimated_price) ?> Ar</td>
                                    <td>
                                        <div class="actions">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#itemModal-<?= esc($item->id) ?>">
                                                <i class="fas fa-eye"></i> See
                                            </button>
                                            <form method="post" action="<?= site_url('item/getFormUpdate/') ?>" class="d-inline">
                                                <input type="hidden" value="<?= $item->id ?>" name="item_id">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fas fa-edit"></i> Update
                                                </button>
                                            </form>
                                            <a href="<?= site_url('item/delete/' . $item->id); ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                            <form action="<?= site_url('item/searchPercent/') ?>" method="post" class="d-inline-block percent-range">
                                                <input type="hidden" value="<?= $item->id ?>" name="item_id">
                                                <select name="percent" id="percent" class="form-select d-inline-block w-auto">
                                                    <option value="10">10%</option>
                                                    <option value="20">20%</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search"></i> Search
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal for Item Details -->
                                <div class="modal fade" id="itemModal-<?= esc($item->id) ?>" tabindex="-1" aria-labelledby="itemModalLabel-<?= esc($item->id) ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header capitalize">
                                                <h5 class="modal-title" id="itemModalLabel-<?= esc($item->id) ?>"><?= esc($item->title) ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><span class="miavaka">Description:</span> <?= esc($item->description) ?></p>
                                                <p><span class="miavaka">Price:</span> <?= esc($item->estimated_price) ?> Ar</p>
                                                <?php foreach ($photos as $photo): ?>
                                                    <img src="<?= base_url('uploads/' . $photo) ?>" class="img-fluid mb-2" alt="Item photo">
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal for Item Details -->
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="<?= site_url('/item/create') ?>" class="btn btn-primary mt-3">
                            <i class="fas fa-plus"></i> Create an Item
                        </a>
                    </div>
                <?php else: ?>
                    <p class="text-center">No items available.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Section des demandes d'échange -->
        <div class="exchanges-container">
            <h2>Exchange requests</h2>
            <?php if (!empty($exchanges) && is_array($exchanges)): ?>
                <table>
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
                            <td class="capitalize"><?= esc($exchange->offered_item_title) ?></td>
                            <td class="capitalize"><?= esc($exchange->requested_item_title) ?></td>
                            <td><?= esc($exchange->recipient_name) ?></td>
                            <td><?= esc($exchange->exchange_date) ?></td>
                            <td>
                                <span  class="type <?= $exchange->status == 'accepted' ? 'holiday' : 'unpaid-leave' ?>">
                                <?= esc($exchange->status) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($exchange->status === 'accepted'): ?>
                                    <span class="text-success">Already Accepted</span>
                                <?php else: ?>
                                    <?php if ($exchange->requester_name === $user['username']): ?>
                                        <span class="text-warning">Request sent</span>
                                    <?php else: ?>
                                        <a href="<?= site_url('exchange/accept/' . $exchange->id); ?>" class="btn btn-secondary">Accept</a>
                                    <?php endif; ?>
                                    <a href="<?= site_url('exchange/decline/' . $exchange->id); ?>" class="btn btn-danger">
                                        <?php if ($exchange->requester_name === $user['username']): ?>
                                            Cancel
                                        <?php else: ?>
                                            Decline
                                        <?php endif; ?>
                                    </a>
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

    <?php else: ?>
        <!-- Liste des utilisateurs pour l'admin -->
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
                                    <a href="<?= site_url('admin/delete/' . $user->id); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
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
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
