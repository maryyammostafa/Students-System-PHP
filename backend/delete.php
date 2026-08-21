<?php

require_once __DIR__ . "/helpers.php";
require_once __DIR__ . "/../database/connection.php";

header('Content-Type: application/json; charset=UTF-8');

if($_SERVER["REQUEST_METHOD"] !== "POST")
    throwError(405,"Method Not Allowed");

if(!isset($_POST['studentId']))
    throwAPIError(422,"Unprocessable Entity");

connection()->exec("DELETE FROM students WHERE id = '{$_POST['studentId']}'");

throwAPIError(200,'Deleted Successfully');