<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('style/layout.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('style/infoUser.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
<div class="sidebar-wrapper">
    <div class="sidebar" id="sidebar">
        <div class="profile">
            <img src="<?= base_url("/tonnyjohmascotte.png") ?>" alt="profile pic">
            <span><?= esc(session()->get('name')) ?></span>
        </div>
        <div class="indicator" id="indicator"></div>
        <ul>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('/') ?>"><i class="fas fa-home"></i> Home</a>
            </li>
            <?php if(session()->get("role")!='admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/item/listItems') ?>"><i class="fas fa-list"></i>Takalo</a>
                </li>
            <?php endif; ?>

            <?php if (session()->get("isLoggedIn")): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/auth/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/auth/login') ?>"><i class="fas fa-sign-in-alt"></i> Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <button class="toggle-btn" id="toggleBtn">
        <i class="fa-solid fa-chevron-right"></i>
    </button>
</div>

<div class="main-content-wrapper">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Dashboard</h1>
        <?php if (session()->get("role") == 'admin'): ?>
            <div class="btn-toolbar mb-2 mb-md-0">
                <form id="form_search" class="d-flex">
                    <input id="search_input" name="search_input" class="form-control me-2" type="search" placeholder="Search by name"
                           aria-label="Search">
                    <button style="margin-right: 5px" class="btn btn-outline-success">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <?= $this->renderSection('content') ?>
</div>

<footer class="footer mt-auto py-3">
    <script>
        <?php if (session()->get('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?= session()->get('success') ?>',
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
        <?php endif; ?>

        <?php if (session()->get('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?= session()->get('error') ?>',
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
        <?php endif; ?>
    </script>
    <?php echo \Config\Services::validation()->listErrors(); ?>
</footer>


<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Details</h5>
            </div>
            <div class="modal-body" id="userDetails">
            </div>

        </div>
    </div>
</div>
<script>

    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleBtn');
    const indicator = document.getElementById('indicator');
    const menuItems = document.querySelectorAll('.sidebar ul li');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        toggleBtn.innerHTML = sidebar.classList.contains('open')
            ? '<i class="fa-solid fa-chevron-left"></i>'
            : '<i class="fa-solid fa-chevron-right"></i>';
    });

    menuItems.forEach((item) => {
        item.addEventListener('mouseover', () => {
            const itemHeight = item.offsetHeight;
            const offsetTop = item.offsetTop;
            indicator.style.top = `${offsetTop}px`;
            indicator.style.height = `${itemHeight}px`;
        });
    });

    // SCRIPT pour le FETCH
    if(document.getElementById("form_search")) {
        document.getElementById('form_search').addEventListener('input', function (event) {
            event.preventDefault();
            const searchInputValue = document.getElementById('search_input').value;
            fetch('<?= site_url("/fetch.php") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ query: searchInputValue })
            }).then(function (res) {
                if (res.ok) {
                    return res.json();
                }
            }).then(function (data) {
                console.log(data.data)

                afficherResultats(data.data);
            }).catch(function (err) {
                console.log("Erreur " + err);
            });
        });
    }

    function afficherResultats(data) {
        const modalBody = document.getElementById('userDetails');
        modalBody.innerHTML = '';

        const userElement = document.createElement('div');
        userElement.classList.add('accordion', 'accordion-flush');
        userElement.innerHTML = `
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading${data.user.id}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse${data.user.id}" aria-expanded="false" aria-controls="flush-collapse${data.user.id}">
                    ${data.user.username}
                </button>
            </h2>
            <div id="flush-collapse${data.user.id}" class="accordion-collapse collapse" aria-labelledby="flush-heading${data.user.id}" data-bs-parent="#userDetails">
                <div class="accordion-body">
                    <p><strong>Email:</strong> ${data.user.email}</p>
                    <p><strong>Role:</strong> ${data.user.role}</p>
                    <p><strong>Item Count:</strong> ${data.item_count}</p>
                    <p><strong>Exchanges Offered:</strong> ${data.exchanges_offered}</p>
                    <p><strong>Exchanges Received:</strong> ${data.exchanges_received}</p>
                </div>
            </div>
        </div>
    `;
        modalBody.appendChild(userElement);

        const modal = new bootstrap.Modal(document.getElementById('userModal'));
        modal.show();
    }

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>
