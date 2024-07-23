<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    require_once 'db.php';
    require_once 'functions.php';

    $errors = [];

    if (emptyInputLogin($email, $pwd)) {
        $errors[] = "emptyinput";
    }

    if (!empty($errors)) {
        echo json_encode(["error" => $errors]);
        exit();
    }

    $loginResult = loginUser($conn, $email, $pwd);

    if ($loginResult["error"]) {
        echo json_encode(["error" => $loginResult["error"]]);
    } else {
        echo json_encode(["message" => "Login successful", "user" => $loginResult["user"]]);
    }
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
