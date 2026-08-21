<?php

require_once __DIR__ . "/helpers.php";
require_once __DIR__ . "/../database/connection.php";

function getData(string $condition = "", int $page = 1){
    $offset = ($page * 10) - 10;
    $result = (connection()->query("SELECT * FROM students
                                    WHERE first_name LIKE '%{$condition}%'
                                    OR last_name LIKE '%{$condition}%'
                                    OR email LIKE '%{$condition}%'
                                    OR age LIKE '%{$condition}%'
                                    OR phone LIKE '%{$condition}%'
                                    LIMIT 10 OFFSET {$offset}
                                    "))->fetchAll();
    return $result;
}

function getCount(string $condition = ""){
    return (connection()->query("SELECT COUNT(*) AS total FROM students
                                WHERE first_name LIKE '%{$condition}%'
                                OR last_name LIKE '%{$condition}%'
                                OR email LIKE '%{$condition}%'
                                OR age LIKE '%{$condition}%'
                                OR phone LIKE '%{$condition}%'
                                "))->fetch()['total'];
}