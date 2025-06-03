<?php
session_start();
require_once 'conexao.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: formulario.php");
    exit;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe os dados do formulário
    $usuario_id = $_SESSION['usuario_id'];  // ID do usuário da sessão
    $servico_id = $_POST['servico_id'] ?? null;  // ID do serviço selecionado
    $data = $_POST['data'] ?? null;  // Data selecionada
    $horario = $_POST['horario'] ?? null;  // Horário selecionado
    $local = $_POST['local'] ?? null;  // Unidade escolhida

$data = json_decode(file_get_contents('php://input'), true);
    // Verifica se todos os campos obrigatórios foram preenchidos
if (empty($data['servico_id']) || empty($data['data']) || empty($data['horario']) || empty($data['local'])) {
        echo "Preencha todos os campos obrigatórios.";
        exit;
    }

    try {
        // Insere o agendamento no banco de dados
        $stmt = $pdo->prepare("INSERT INTO agendamentos (usuario_id, servico_id, data, horario, local)
                                VALUES (:usuario_id, :servico_id, :data, :horario, :local)");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':servico_id', $servico_id);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':local', $local);

        // Executa o statement
        if ($stmt->execute()) {
            // Redireciona após sucesso
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao tentar agendar. Por favor, tente novamente.";
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