<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../utils/conn.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    session_start();
    $user = $result->fetch_assoc();

    $_SESSION['email'] = $user['email'];
    $_SESSION['nama'] = $user['name'];

    header("Location: ./dashboard.php");
    exit();
} else {
    header("Location: ./login.php?error=email or password is incorrect");
    exit();
}
?>
