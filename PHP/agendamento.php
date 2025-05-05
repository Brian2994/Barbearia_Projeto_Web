<?php 

session_start();
require_once 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $usuario_id = $_SESSION['usuario_id'];
    $servico_id = $_POST['servico_id'] ?? null;
    $data = $_POST['data'] ?? null;
    $horario = $_POST['horario'] ?? null;
    $plano_id = $_POST['plano_id'] ?? null;
    $local = $_GET['local'] ?? null;

    if (!$servico || !$data || !$horario || !$local) {
        echo "Preencha todos os campos obrigatórios.";
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO agendamentos (usuario_id, servico_id, plano_id, data, horario)
                                VALUES (:usuario_id, :servico_id, :plano_id, :data, :horario)");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':servico_id', $servico_id);
        $stmt->bindParam(':plano_id', $plano_id);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':local', $local);
        $stmt->execute();
        
        header("Location: painel.php?msg=agendado");
    } catch (PDOException $e) {
        echo "Erro ao agendar:" . $e->getMessage();
    }
} else {
    echo "Método inválido.";
}
?>