<?php

session_start();
require_once __DIR__ . "/helpers.php";
require_once __DIR__ . "/../database/connection.php";

if($_SERVER['REQUEST_METHOD'] !== 'GET')
    throwError(405,"Method Not Allowed");

if(!isset($_GET['studentId']))
    throwError(422,"Unprocessable Entity");

if(empty($_SESSION['_errors'])){
    $student = connection()->query("SELECT * FROM students WHERE id = '{$_GET['studentId']}'")->fetch();

    if(empty($student))
        throwError(422,"Invalid ID");

    $_SESSION['_old'] = [
        'id' => $student['id'],
        'firstName' => $student['first_name'],
        'lastName' => $student['last_name'],
        'email' => $student['email'],
        'age' => $student['age'],
        'phone' => $student['phone']
    ];
}