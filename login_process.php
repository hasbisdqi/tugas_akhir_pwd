<?php
require './utils/conn.php';

$nik = $_POST['nik'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM residents WHERE nik = ? AND password = ? LIMIT 1");
$stmt->bind_param("ss", $nik, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    session_start();
    $user = $result->fetch_assoc();

    $_SESSION['nik'] = $user['nik'];
    $_SESSION['nama'] = $user['full_name'];

    header("Location: dashboard.php");
    exit();
} else {
    header("Location: login.php?error=nik or password is incorrect");
    exit();
}
?>
