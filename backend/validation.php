<?php

require_once __DIR__ . "/../database/connection.php";

function validate(){
    foreach ($_POST as $field => $value){
        validateRequired($field, $value);
        if($field === "firstName" || $field === "lastName")
            validateName($field, $value);
        else if($field === "email"){
            validateEmail($field, $value);
            validateUnique($field, $value, 'students');
        }
        else if($field === "password")
            validatePassword($field, $value);
        else if($field === "age")
            validateAge($field, $value);
        else if($field === "phone"){
            validatePhone($field, $value);
            validateUnique($field, $value, 'students');
        }
    }
    if(!empty($_SESSION['_errors']))
        back();
}
function editValidate(){
    foreach ($_POST as $field => $value){
        if($field !== "password")
            validateRequired($field, $value);
        if($field === "firstName" || $field === "lastName")
            validateName($field, $value);
        else if($field === "email"){
            validateEmail($field, $value);
            validateUnique($field, $value, 'students', $_POST['id']);
        }else if($field === "password")
            validatePassword($field, $value);
        else if($field === "age")
            validateAge($field, $value);
        else if($field === "phone"){
            validatePhone($field, $value);
            validateUnique($field, $value, 'students', $_POST['id']);
        }
    }
    if(!empty($_SESSION['_errors']))
        back();
}
function validateRequired(string $field, mixed $value){
    if ($value === null || trim((string)$value) === "")
        addError($field, "{$field} is required.");
}
function validateName(string $field, mixed $value){
    if (empty($value))
        return;
    if(!preg_match("/^[a-zA-Z]+( [a-zA-Z]+)*$/",$value))
        addError($field, "{$field} must contain only characters.");
}
function validateEmail(string $field, mixed $value){
    if (empty($value))
        return;
    $regex = "/^[A-Za-z]+[A-Za-z0-9_\-.]+@(gmail|yahoo)\.(com|org)$/";
    if (!preg_match($regex, $value))
        addError($field, "{$field} must be a valid email.");
}
function validatePassword(string $field, mixed $value){
    if (empty($value))
        return;
    if (strlen($value) < 8)
        addError($field, "{$field} must be at least 8 characters.");
}
function validateAge(string $field, mixed $value){
    if (empty($value))
        return;
    if (!ctype_digit((string)$value) || (int)$value <= 10)
        addError($field, "{$field} must be a number greater than 10.");
}
function validatePhone(string $field, mixed $value){
    if (empty($value))
        return;
    $regex = "/^(02)?01(0|1|2|5)[0-9]{8}$/";
    if (!preg_match($regex, $value)) 
        addError($field, "{$field} must be a valid Egyptian Phone.");
}
function validateUnique(string $field, mixed $value, string $tableName, ?string $exceptId = null): void{
    if (empty($value))
        return;
    $DB = connection();
    $subQuery = "";
    if($exceptId !== null)
        $subQuery = "AND id != {$exceptId}";
    $stmt = $DB->query("SELECT * FROM {$tableName} WHERE {$field} = '{$value}' {$subQuery}");
    if (!empty($stmt->fetchAll()))
        addError($field, "This {$field} is already exists.");
}
function addError(string $field, mixed $error){
    $_SESSION['_errors'][$field][] = $error;
}