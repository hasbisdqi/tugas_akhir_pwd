<?php
session_start();
$auth = isset($_SESSION['nik']) || isset($_SESSION['email']);
if (!$auth) {
    header('location:login.php?error=Anda belum login!');
}
