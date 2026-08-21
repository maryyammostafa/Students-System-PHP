<?php session_start(); require_once __DIR__ . "/backend/helpers.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students-System</title>
    <link rel="shortcut icon" href="assets/Images/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/CSS/plugins/all.min.css">
    <link rel="stylesheet" href="assets/CSS/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="assets/CSS/index.css">
    <link rel="stylesheet" href="assets/CSS/index.responsive.css">
</head>
<body>

    <section id="Registration" class="py-5">
        <div class="container">
            <div class="image text-center">
                <img src="assets/Images/logo.png" class="img-fluid mb-5" alt="">
            </div>
            <div class="box">
                <h4 class="text-center pt-4">Students System</h4>
                <form action="backend/register.php" method="POST" autocomplete="off" class="p-4" data-type="add">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" name="firstName" placeholder="First Name *" value="<?= getOld("firstName") ?>">
                        <?= getAlert('firstName') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" name="lastName" placeholder="Last Name *" value="<?= getOld("lastName") ?>">
                        <?= getAlert('lastName') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" name="email" placeholder="Email *" value="<?= getOld("email") ?>">
                        <?= getAlert('email') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password *">
                        <?= getAlert('password') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                        <input type="number" class="form-control" name="age" min="5" placeholder="Age *" value="<?= getOld("age") ?>">
                        <?= getAlert('age') ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-mobile"></i></span>
                        <input type="text" class="form-control" name="phone" placeholder="Phone *" value="<?= getOld("phone") ?>">
                        <?= getAlert('phone') ?>
                    </div>
                    <button class="btn btn-success w-100">Add</button>
                </form>
            </div>
        </div>
    </section>

    <section id="Filtration" class="pb-5">
        <div class="container">
            <form class="search mb-5 d-flex" action="" method="POST">
                <div class="input-group input me-2">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search...">
                </div>
                <button class="btn btn-success px-3">Search</button>
            </form>
            <div class="cover overflow-auto">
                <div class="table-responsive">
                    <table class="table rounded overflow-hidden m-auto">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Age</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include __DIR__."/components/tableRows.php"; ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mt-3">
                            <?php include __DIR__."/components/pagination.php"; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/JS/plugins/bootstrap.min.js"></script>
    <script src="assets/JS/plugins/jQuery.js"></script>
    <script src="assets/JS/plugins/sweetAlert.js"></script>
    <script src="assets/JS/index.js"></script>
</body>
</html>