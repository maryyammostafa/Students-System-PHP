<?php

require_once __DIR__ . "/../backend/getData.php";

$page = 1;

if (isset($_GET['page']) && $_GET['page'] > 1)
    $page = $_GET['page'];

$students = getData("", $page);

$tbody = "";

foreach($students as $student){
    $pass = substr($student['password'],0,15);
    $tbody .= "
        <tr data-id='{$student['id']}'>
            <th>{$student['id']}</th>
            <td>{$student['first_name']} {$student['last_name']}</td>
            <td>{$student['email']}</td>
            <td>{$pass}...</td>
            <td>{$student['age']}</td>
            <td>{$student['phone']}</td>
            <td>
                <a href='edit.php?studentId={$student['id']}' class='btn btn-primary text-light me-2 edit'>Edit</a>
                <button class='btn btn-danger delete' onclick='deleteStudent({$student['id']})'>Delete</button>
            </td>
        </tr>";
}

echo $tbody;