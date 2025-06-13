<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
  header("Location: formulario.php");
  exit;
  }
// --- PARTE 1: TRATAMENTO DA API (REQUISIÇÃO POST) ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($_SESSION['usuario_id'])) {
        http_response_code(401);
        echo json_encode(["status" => "error", "message" => "Usuário não logado. Faça login para agendar."]);
        exit;
    }

    $usuario_id = $_SESSION['usuario_id'];
    $servico_id = $input['servico_id'] ?? null;
    $data = $input['data'] ?? null;
    $horario = $input['horario'] ?? null;
    $local = $input['local'] ?? null;

    if (!$servico_id || !$data || !$horario || !$local) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Preencha todos os campos obrigatórios."]);
        exit;
    }
    try {
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM agendamentos WHERE local = :local AND data = :data AND horario = :horario");
        $stmt_check->bindParam(':local', $local);
        $stmt_check->bindParam(':data', $data);
        $stmt_check->bindParam(':horario', $horario);
        $stmt_check->execute();
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            http_response_code(409);
            echo json_encode(["status" => "error", "message" => "❌ Desculpe, este horário não está mais disponível. Por favor, escolha outro."]);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO agendamentos (usuario_id, servico_id, data, horario, local)
                                VALUES (:usuario_id, :servico_id, :data, :horario, :local)");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':servico_id', $servico_id);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':local', $local);

        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(["status" => "success", "message" => "✅ Seu pedido foi agendado com sucesso!"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "❌ Erro ao tentar agendar. Por favor, tente novamente."]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        error_log("Erro ao agendar: " . $e->getMessage());
        echo json_encode(["status" => "error", "message" => "Erro interno no servidor ao tentar agendar."]);
    }
    exit;
}

// --- PARTE 2: LÓGICA DA PÁGINA (REQUISIÇÃO GET) ---
if (!isset($_SESSION['usuario_id'])) {
    header("Location: formulario.php");
    exit;
}

$servico_selecionado = $_GET['servico'] ?? '';
$mapa_servicos = [
    'barba' => 1, 'cabelo' => 2, 'higiene_e_cuidados' => 3, 'corte_e_barba' => 4
];
$servico_id_para_link = $mapa_servicos[$servico_selecionado] ?? 0;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Agendamentos</title>
  <link rel="stylesheet" href="/HTML/assets/css/agendamento.css" />
</head>
<body>
  <h1>Escolha sua barbearia</h1>
  <div class="gallery">
    <div class="card rotate-left card-vila">
      <h2>VILA OLÍMPIA</h2>
      <p>Rua Quatá, 123 - Vila Olímpia<br>Estacionamentos de veículos<br>(11) 5254-8546<br><strong>Horários de funcionamento:</strong><br>Segunda a sexta: 9h às 20h<br>Sábado: 9h às 18h</p>
      <a href="agenda.php?local=vila-olimpia&servico_id=<?php echo $servico_id_para_link; ?>">Agendar</a>
    </div>
    <div class="card rotate-slight-left card-itaim">
      <h2>ITAIM BIBI</h2>
      <p>Rua Tabapuã, 321 - Itaim Bibi<br>Estacionamentos de veículos<br>(11) 5254-8546<br><strong>Horários de funcionamento:</strong><br>Segunda a sexta: 9h às 20h<br>Sábado: 9h às 18h</p>
      <a href="agenda.php?local=itaim-bibi&servico_id=<?php echo $servico_id_para_link; ?>">Agendar</a>
    </div>
    <div class="card rotate-slight-right card-moema">
      <h2>MOEMA</h2>
      <p>Avenida Rouxinol, 123 - Moema<br>Estacionamentos de veículos<br>(11) 5254-8546<br><strong>Horários de funcionamento:</strong><br>Segunda a sexta: 9h às 20h<br>Sábado: 9h às 18h</p>
      <a href="agenda.php?local=moema&servico_id=<?php echo $servico_id_para_link; ?>">Agendar</a>
    </div>
    <div class="card rotate-right card-oscar">
      <h2>HIGIENÓPOLIS</h2>
      <p>Avenida Angélica, 321 - Higienópolis<br>Estacionamentos de veículos<br>(11) 5254-8546<br><strong>Horários de funcionamento:</strong><br>Segunda a sexta: 9h às 20h<br>Sábado: 9h às 18h</p>
      <a href="agenda.php?local=higienopolis&servico_id=<?php echo $servico_id_para_link; ?>">Agendar</a>
    </div>
  </div>
</body>
</html>