<?php session_start(); require_once __DIR__ . "/backend/helpers.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students-System</title>

    <link rel="stylesheet" href="assets/CSS/plugins/all.min.css">
    <link rel="stylesheet" href="assets/CSS/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="assets/CSS/index.css">
    <link rel="stylesheet" href="assets/CSS/index.responsive.css">
</head>
<body>

    <section id="Registration" class="py-5">
        <div class="container">
            <div class="box pt-4">
                <div class="head">
                    <span class="icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </span>
                    <h2>Students System</h2>
                    <p>Add a new student</p>
                </div>
                <?= getAlert('added','success') ?>
                <?= getAlert('edited','success') ?>
                <form action="backend/register.php" method="POST" autocomplete="off" class="py-4 px-3 px-md-4">
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
                    <button class="btn add w-100"><i class="fa-solid fa-plus me-2"></i> Add Student</button>
                </form>
            </div>
        </div>
    </section>

    <section id="Filtration" class="pb-5 pt-4">
        <div class="container">
            <div class="section-title">
                <span>STUDENT RECORDS</span>
                <h2>All Students</h2>
            </div>
            <form class="search mb-5 d-flex" action="" method="POST">
                <div class="input-group input me-md-2 mb-3 mb-md-0">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search...">
                </div>
                <button class="btn search-btn px-3"><i class="fa-solid fa-magnifying-glass me-1"></i> Search</button>
            </form>
            <div class="cover table-card overflow-auto">
                <div class="table-responsive">
                    <table class="table rounded overflow-hidden m-auto">
                        <thead>
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