<?php
require_once '../utils/conn.php'; 
if (!isset($_POST['id'])) {
    header('Location: dashboard.php?error=missing_id');
    exit;
}

$id = intval($_POST['id']);

$stmt = $conn->prepare("DELETE FROM residents WHERE id = ?");
if ($stmt->execute([$id])) {
    header('Location: dashboard.php?success=deleted');
    exit;
} else {
    header('Location: dashboard.php?error=delete_failed');
    exit;
}
?>