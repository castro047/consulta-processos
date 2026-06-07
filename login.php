<?php
require_once 'auth.php';
require_once '../config.php';

$empresaId = $_SESSION['empresa_id'];
$id = $_GET['id'] ?? '';

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM processos WHERE id = ? AND empresa_id = ?");
    $stmt->execute([$id, $empresaId]);
}

header('Location: dashboard.php');
exit;
?>
