<?php
require_once 'config.php';
header('Content-Type: application/json');

$id = $_POST['id'] ?? '';

try {
    $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(['success' => true]);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>