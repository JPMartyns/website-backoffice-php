<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = intval($_GET['id']);
    $estado = intval($_GET['estado']); // 1 ou 0

    $sql = "UPDATE contactos SET lida = $estado WHERE id_contacto = $id";
    $connection->query($sql);
}

header("Location: form-checker.php");
exit;
