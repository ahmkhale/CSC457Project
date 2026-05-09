<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM places WHERE id = ?");
$stmt->execute([$id]);

header("Location: dashboard.php?message=deleted");
exit;
?>