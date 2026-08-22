<?php

require_once __DIR__ . "/getData.php";
require_once __DIR__ . "/helpers.php";

header('Content-Type: application/json; charset=UTF-8');

if($_SERVER['REQUEST_METHOD'] !== 'POST')
    throwAPIError(405,"Method Not Allowed");

if(!isset($_POST['search']))
    throwAPIError(422,"Unprocessable Entity");

$page = $_POST['page'] ?? 1;
$students = getData(trim($_POST['search']),$page);
$total = getCount(trim($_POST['search']));

echo json_encode([
    "students" => $students,
    "total" => $total
]);