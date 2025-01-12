<?php
require_once 'config.php';
header('Content-Type: application/json');

$search = $_GET['search'] ?? '';

try {
    $sql = "SELECT id, name, contact, username FROM employees 
            WHERE name LIKE ? OR username LIKE ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$search%", "%$search%"]);
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'data' => $employees]);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>