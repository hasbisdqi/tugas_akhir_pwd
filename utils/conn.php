<?php
$conn = new mysqli('localhost', 'root', '', 'ktp');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
