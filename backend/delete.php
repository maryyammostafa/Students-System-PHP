<?php

require_once __DIR__ . "/helpers.php";
require_once __DIR__ . "/../database/connection.php";
require_once __DIR__ . "/getData.php";

header('Content-Type: application/json; charset=UTF-8');

if($_SERVER["REQUEST_METHOD"] !== "POST")
    throwError(405,"Method Not Allowed");

if(!isset($_POST['studentId']))
    throwAPIError(422,"Unprocessable Entity");

connection()->exec("DELETE FROM students WHERE id = '{$_POST['studentId']}'");

$page = $_POST['page'] ?? 1;
$total = getCount(trim($_POST['search']) ?? "");
$numberOfPages = ceil($total / 10);
if($page > $numberOfPages) $page = $numberOfPages;
$page = ($page == 0) ? 1 : $page;
$students = getData(trim($_POST['search']) ?? "", $page);

echo json_encode([
    "status" => 200,
    "message" => "Deleted Successfully",
    "students" => $students,
    "total" => $total,
    "page" => $page
]);