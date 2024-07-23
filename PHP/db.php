<?php
$serverName = "localhost";
$dbUsername = "Thishmi Amaya";
$dbPassword = "hsOPQADEj[rx8!Cn";
$dbName = "tastytrails_signin";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>