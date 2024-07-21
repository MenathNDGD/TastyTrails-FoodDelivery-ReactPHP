<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["uid"] ?? null;
    $name = $_POST["name"] ?? null;
    $email = $_POST["email"] ?? null;
    $pwd = $_POST["pwd"] ?? null;

    require_once 'db.php';
    require_once 'functions.php'; 

    $errors = [];

    // Validate input
    if (emptyInputSignup($name, $email, $username, $pwd)) {
        $errors[] = "emptyinput";
    }
    if (invalidUid($username)) {
        $errors[] = "invaliduid";
    }
    if (invalidEmail($email)) {
        $errors[] = "invalidemail";
    }
    if (!pwdMatch($pwd, $pwd)) {
        $errors[] = "passwordsdoesnotmatch";
    }
    if (uidExists($conn, $username, $email)) {
        $errors[] = "uidexists";
    }

    if (!empty($errors)) {
        echo json_encode(["error" => $errors]);
        exit();
    }

    // Create user
    createUser($conn, $name, $email, $username, $pwd);
    echo json_encode(["message" => "User created successfully"]);
    header('Location:../login.php');
    exit();
    
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
