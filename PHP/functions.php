<?php
function emptyInputSignup($name, $email, $username, $pwd) {
    return empty($name) || empty($email) || empty($username) || empty($pwd);
}

function invalidUid($username) {
    return !preg_match("/^[a-zA-Z0-9]*$/", $username);
}

function invalidEmail($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function pwdMatch($pwd, $pwdMatch) {
    return $pwd !== $pwdMatch;
}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return true;
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
        return false;
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
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
