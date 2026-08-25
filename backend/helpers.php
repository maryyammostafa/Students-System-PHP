<?php

function pr(mixed $data, bool $exit = false){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if($exit)
        exit;
}

function throwError(int $code, string $message = ""){
    http_response_code($code);
    echo $message;
    exit;
}

function throwAPIError(int $code, string $message = ""){
    http_response_code($code);
    echo json_encode([
        "status" => $code,
        "message" => $message
    ]);
    exit;
}

function back(){
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

// function getAlert(string $key){
//     $err = "";
//     if(isset($_SESSION['_errors'][$key])){
//         $err = "<p class='alert text-danger w-100 m-0 ms-1 mt-1 p-0'>{$_SESSION['_errors'][$key][0]}</p>";
//         unset($_SESSION['_errors'][$key]);
//     }
//     return $err;
// }

function getAlert(string $key, string $type): string{
    $alert = "";
    if($type == 'error' && isset($_SESSION['_errors'][$key])){
        $alert = "<p class='alert text-danger w-100 m-0 ms-1 mt-1 p-0'>{$_SESSION['_errors'][$key][0]}</p>";
        unset($_SESSION['_errors'][$key]);
    }else if($type == 'success' && isset($_SESSION[$key])){
        $alert = "<p class='alert msg text-success fs-4 p-0 m-0 mt-3 text-center fw-bolder'><i class='fa-solid fa-circle-check text-success'></i> {$_SESSION[$key]}</p>";
        unset($_SESSION[$key]);
    }
    return $alert;
}

function getOld(string $key){
    $old = $_SESSION['_old'][$key] ?? "";
    unset($_SESSION['_old'][$key]);
    return $old;
}