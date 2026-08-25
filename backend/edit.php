<?php

session_start();
require_once __DIR__ . "/helpers.php";
require_once __DIR__ . "/validation.php";
require_once __DIR__ . "/../database/connection.php";

if($_SERVER['REQUEST_METHOD'] !== 'POST')
    throwError(405,"Method Not Allowed");

$_SESSION['_errors'] = [];
$_SESSION['_old'] = $_POST;

editValidate();

$pass = "";

if(isset($_POST['password']) && !empty($_POST['password'])){
    $hash = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $pass = "password = '{$hash}',";
}

$DB = connection();

$before = $DB->query("SELECT * FROM students WHERE id = '{$_POST['id']}'")->fetch();

$DB->exec("UPDATE students SET
            first_name = '{$_POST['firstName']}',
            last_name = '{$_POST['lastName']}',
            email = '{$_POST['email']}',
            {$pass}
            age = '{$_POST['age']}',
            phone = '{$_POST['phone']}'
            WHERE id = '{$_POST['id']}'
            ");

$after = $DB->query("SELECT * FROM students WHERE id = '{$_POST['id']}'")->fetch();

if(!($before == $after))
    $_SESSION['edited'] = "Student Edited Successfully";

$_SESSION['_old'] = [];

header("Location: ../index.php");