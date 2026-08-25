<?php require_once __DIR__ . "/backend/helpers.php"; require_once __DIR__ . "/backend/getStudent.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students-System | Edit</title>
    <link rel="shortcut icon" href="assets/Images/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/CSS/plugins/all.min.css">
    <link rel="stylesheet" href="assets/CSS/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="assets/CSS/index.css">
    <link rel="stylesheet" href="assets/CSS/index.responsive.css">
</head>
<body>

    <section id="Registration" class="py-5 mb-5">
        <div class="container">
            <div class="image text-center">
                <img src="assets/Images/logo.png" class="img-fluid mb-5" alt="">
            </div>
            <div class="box">
                <h2 class="text-center pt-4">Students System</h2>
                <form action="backend/edit.php" method="POST" autocomplete="off" class="p-4">
                    <input type="hidden" name="id" value="<?= getOld("id") ?>">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control rounded-end" name="firstName" placeholder="First Name *" value="<?= getOld("firstName") ?>">
                        <?= getAlert('firstName','error') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control rounded-end" name="lastName" placeholder="Last Name *" value="<?= getOld("lastName") ?>">
                        <?= getAlert('lastName','error') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control rounded-end" name="email" placeholder="Email *" value="<?= getOld("email") ?>">
                        <?= getAlert('email','error') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control password" name="password" onkeyup="toggleEye(this)" placeholder="Password *">
                        <span class="input-group-text eye rounded-end"><i class="fa-solid fa-eye icon" onclick="togglePassword(this)"></i></span>
                        <?= getAlert('password','error') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                        <input type="text" class="form-control rounded-end" name="age" placeholder="Age *" value="<?= getOld("age") ?>">
                        <?= getAlert('age','error') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-mobile"></i></span>
                        <input type="text" class="form-control rounded-end" name="phone" placeholder="Phone *" value="<?= getOld("phone") ?>">
                        <?= getAlert('phone','error') ?>
                    </div>
                    <button class="btn btn-info text-light w-100">Edit</button>
                </form>
            </div>
        </div>
    </section>

    <script src="assets/JS/plugins/bootstrap.min.js"></script>
    <script src="assets/JS/plugins/jQuery.js"></script>
    <script src="assets/JS/plugins/sweetAlert.js"></script>
    <script src="assets/JS/index.js"></script>
</body>
</html>