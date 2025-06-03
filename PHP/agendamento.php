<?php
session_start();
require_once 'conexao.php';


if (!isset($_SESSION['usuario_id'])) {
    header("Location: formulario.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents('php://input'), true);

    $usuario_id = $_SESSION['usuario_id'];
    $servico_id = $input['servico_id'] ?? null;
    $data = $input['data'] ?? null;
    $horario = $input['horario'] ?? null;
    $local = $input['local'] ?? null;

    if (!$servico_id || !$data || !$horario || !$local) {
        http_response_code(400);
        echo "Preencha todos os campos obrigatórios.";
        exit;
    }
    try {
        $stmt = $pdo->prepare("INSERT INTO agendamentos (usuario_id, servico_id, data, horario, local)
                                VALUES (:usuario_id, :servico_id, :data, :horario, :local)");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':servico_id', $servico_id);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':local', $local);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "❌ Erro ao tentar agendar. Por favor, tente novamente.";
        }
    } catch (PDOException $e) {
        echo "Erro ao agendar: " . $e->getMessage();
    }
  } else {
    echo "Método inválido.";
}
?>

<!-- Formulário HTML na mesma página -->
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
      <p>
        Rua Quatá, 123 - Vila Olímpia<br>
        Estacionamentos de veículos<br>
        (11) 5254-8546<br>
        <strong>Horários de funcionamento:</strong><br>
        Segunda a sexta: 9h às 20h<br>
        Sábado: 9h às 18h
      </p>
      <a href="agenda.php?local=vila-olimpia">Agendar</a>
    </div>
    <div class="card rotate-slight-left card-itaim">
      <h2>ITAIM BIBI</h2>
      <p>
        Rua Tabapuã, 321 - Itaim Bibi<br>
        Estacionamentos de veículos<br>
        (11) 5254-8546<br>
        <strong>Horários de funcionamento:</strong><br>
        Segunda a sexta: 9h às 20h<br>
        Sábado: 9h às 18h
      </p>
      <a href="agenda.php?local=itaim-bibi">Agendar</a>
    </div>
    <div class="card rotate-slight-right card-moema">
      <h2>MOEMA</h2>
      <p>
        Avenida Rouxinol, 123 - Moema<br>
        Estacionamentos de veículos<br>
        (11) 5254-8546<br>
        <strong>Horários de funcionamento:</strong><br>
        Segunda a sexta: 9h às 20h<br>
        Sábado: 9h às 18h
      </p>
      <a href="agenda.php?local=moema">Agendar</a>
    </div>
    <div class="card rotate-right card-oscar">
      <h2>HIGIENÓPOLIS</h2>
      <p>
        Avenida Angélica, 321 - Higienópolis<br>
        Estacionamentos de veículos<br>
        (11) 5254-8546<br>
        <strong>Horários de funcionamento:</strong><br>
        Segunda a sexta: 9h às 20h<br>
        Sábado: 9h às 18h
      </p>
      <a href="agenda.php?local=higienopolis">Agendar</a>
    </div>
  </div>
    <script src="/HTML/assets/js/agendamento.js"></script>
</body>

</html>