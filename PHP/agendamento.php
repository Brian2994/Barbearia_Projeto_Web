<?php 

session_start();
require_once 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: formulario.php");
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

</body>

</html>