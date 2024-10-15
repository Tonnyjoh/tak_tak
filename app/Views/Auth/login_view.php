<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        *, *:before, *:after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Open Sans', Helvetica, Arial, sans-serif;
            background: #ededed;
        }
        .container {
            max-width: 900px;
            height: 550px;
            margin: 10% auto;
            position: relative;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .form-container {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            padding: 50px;
            background: #fff;
            transition: transform 0.6s ease-in-out;
        }
        .sign-in {
            left: 0;
        }
        .sign-up {
            left: 100%;
        }
        .sub-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
        }
        .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #6c757d url('<?=site_url('/imgLogin.jpg')?>') center center / cover;
            filter: blur(2px);
            z-index: 0;
        }
        .img__text {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            z-index: 1;
        }
        .img__btn {
            cursor: pointer;
            margin:auto;
            padding: 10px 20px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 20px;
            color: #fff;
            font-size: 16px;
            transition: background 0.3s ease;
            width: 100px;
        }
        .img__btn:hover {
            background: rgba(0, 0, 0, 0.8);
        }
        .btn {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border-radius: 30px;
            transition: background 0.3s ease;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .container.s--signup .form-container.sign-in {
            transform: translateX(-100%);
        }
        .container.s--signup .form-container.sign-up {
            transform: translateX(-100%);
        }
        .container.s--signup .sub-container {
            transform: translateX(-100%);
        }
        .message {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            width: 80%;
        }
        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body>

<div class="container" id="auth-container">
    <div class="form-container sign-in">
        <h2>Welcome back,</h2>
        <form action="<?= site_url('auth/login'); ?>" method="post">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" required aria-label="Email">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required aria-label="Password">
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
    </div>

    <div class="form-container sign-up">
        <h2>Time to feel like home,</h2>
        <form action="<?= site_url('auth/register'); ?>" method="post">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" required aria-label="Name">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" required aria-label="Email">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required aria-label="Password">
            </div>
            <button type="submit" class="btn btn-success">Sign Up</button>
        </form>
    </div>

    <div class="sub-container">
        <div class="bg-image"></div>
        <div class="img__text">
            <h2>New here?</h2>
            <p>Sign up and discover a great amount of new opportunities!</p>
            <div class="img__btn" id="toggleSignUp">Sign Up</div>
        </div>
        <div class="img__text" style="display:none;">
            <h2>One of us?</h2>
            <p>If you already have an account, sign in. We've missed you!</p>
            <div class="img__btn" id="toggleSignIn">Sign In</div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const authContainer = document.getElementById('auth-container');
    const toggleSignUp = document.getElementById('toggleSignUp');
    const toggleSignIn = document.getElementById('toggleSignIn');

    toggleSignUp.addEventListener('click', () => {
        authContainer.classList.add('s--signup');
        document.querySelectorAll('.img__text')[1].style.display = 'block'; // Show Sign In text
        document.querySelectorAll('.img__text')[0].style.display = 'none';  // Hide Sign Up text
    });

    toggleSignIn.addEventListener('click', () => {
        authContainer.classList.remove('s--signup');
        document.querySelectorAll('.img__text')[0].style.display = 'block'; // Show Sign Up text
        document.querySelectorAll('.img__text')[1].style.display = 'none';  // Hide Sign In text
    });

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
