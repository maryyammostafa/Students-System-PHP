<?php

function connection(): PDO{
    $DSN = "mysql:host=localhost;dbname=students-system";
    $USERNAME = "root";
    $PASSWORD = "";

    try{
        $DB = new PDO($DSN, $USERNAME, $PASSWORD);
        $DB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }catch(PDOException $error){
        echo "Database Connection Failed: {$error->getMessage()}";
        exit;
    }
    return $DB;
}