<?php
session_start();
// Futuramente, você pode adicionar uma verificação para garantir que apenas um admin acesse
// if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
//     http_response_code(403); // Forbidden
//     echo json_encode(['error' => 'Acesso negado']);
//     exit;
// }

require_once 'conexao.php';

header('Content-Type: application/json');

try {
    $query = "
        SELECT
            ag.id,
            ag.data,
            ag.horario,
            ag.local,
            us.nome AS nome_usuario,
            se.nome AS nome_servico
        FROM
            agendamentos AS ag
        JOIN
            usuarios AS us ON ag.usuario_id = us.id
        JOIN
            servicos AS se ON ag.servico_id = se.id
        ORDER BY
            ag.data DESC, ag.horario ASC
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($agendamentos);

} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    error_log("Erro ao buscar agendamentos: " . $e->getMessage());
    echo json_encode(['error' => 'Erro ao buscar agendamentos.']);
}
