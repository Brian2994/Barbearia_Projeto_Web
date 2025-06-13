<?php
session_start();
require_once 'conexao.php';

header('Content-Type: application/json');

// Futuramente, proteger esta ação para somente os admins
// if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) { ... }

// Pega o corpo da requisição POST
$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'ID do agendamento não fornecido.']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM agendamentos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Agendamento removido com sucesso.']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Falha ao executar a remoção.']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    error_log("Erro ao remover agendamento: " . $e->getMessage());
    echo json_encode(['error' => 'Erro interno do servidor.']);
}

