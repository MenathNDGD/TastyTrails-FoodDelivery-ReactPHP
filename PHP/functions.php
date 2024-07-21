<?php
function emptyInputSignup($name, $email, $username, $pwd) {
    $result;
    if empty($name) || empty($email) || empty($username) || empty($pwd){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdMatch) {
    $result;
    if ($pwd !== $pwdMatch) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    mysqli_stmt_close($stmt);
    return $row ? true : false;
}

function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:C:\Users\Amaya\Documents\GitHub\Tasty_Trails\TastyTrails-FoodDelivery-ReactPHP\src\componentsLoginPopup.jsx?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
        header("Location:C:\Users\Amaya\Documents\GitHub\Tasty_Trails\TastyTrails-FoodDelivery-ReactPHP\src\componentsLoginPopup.jsx?error=stmtfailed");
        exit();
}

function emptyInputLogin($email, $pwd) {
    return empty($email) || empty($pwd);
}

function loginUser($conn, $email, $pwd) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return ["error" => "stmtfailed"];
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);

    if (!$row || !password_verify($pwd, $row["usersPwd"])) {
        return ["error" => "wronglogin"];
    } else {
        session_start();
        $_SESSION["userid"] = $row["usersId"];
        $_SESSION["useruid"] = $row["usersUid"];
        $_SESSION["username"] = $row["usersName"];
        return ["user" => ["userid" => $row["usersId"], "username" => $row["usersName"], "useruid" => $row["usersUid"]]];
    }
}
?>
