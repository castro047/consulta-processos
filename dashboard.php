<?php
session_start();

if (!isset($_SESSION['usuario_id'], $_SESSION['empresa_id'])) {
    header('Location: login.php');
    exit;
}
?>
