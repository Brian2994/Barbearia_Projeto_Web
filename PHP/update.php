<?php
session_start();
require_once 'conexao.php';

header('Content-Type: application/json');

// Futuramente, proteja esta ação para admins
// if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) { ... }

$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;
$data = $input['data'] ?? null;
$horario = $input['horario'] ?? null;

if (!$id || !$data || !$horario) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados incompletos para atualização.']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE agendamentos SET data = :data, horario = :horario WHERE id = :id");
    $stmt->bindParam(':data', $data, PDO::PARAM_STR);
    $stmt->bindParam(':horario', $horario, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Agendamento atualizado com sucesso.']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Falha ao executar a atualização.']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    error_log("Erro ao atualizar agendamento: " . $e->getMessage());
    echo json_encode(['error' => 'Erro interno do servidor.']);
}
?>