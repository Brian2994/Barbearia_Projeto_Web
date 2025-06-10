<?php
// Mostrar errores para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Respuesta JSON
header('Content-Type: application/json');

// Configuración de conexión con Docker (ajustada a tu docker-compose)
$host = 'mysql'; // nombre del servicio del contenedor MySQL
$user = 'teste';
$password = 'testesenha123';
$database = 'projeto';

// Conexión MySQL
$conn = new mysqli($host, $user, $password, $database);

// Validar conexión
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Erro de conexão com o banco de dados"]);
    exit;
}

// Fecha de hoy
$hoje = date('Y-m-d');

// Consulta SQL
$sql = "
    SELECT 
        a.id,
        u.nome AS cliente,
        s.nome AS servico,
        a.data,
        a.horario,
        a.local
    FROM agendamentos a
    JOIN usuarios u ON a.usuario_id = u.id
    JOIN servicos s ON a.servico_id = s.id
    WHERE a.data = ?
    ORDER BY a.horario ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hoje);
$stmt->execute();
$result = $stmt->get_result();

$agendas = [];

while ($row = $result->fetch_assoc()) {
    $agendas[] = [
        "titulo" => $row['cliente'] . " - " . $row['servico'],
        "descripcion" => "Local: {$row['local']} | Hora: {$row['horario']}",
        "fecha" => $row['data']
    ];
}

echo json_encode($agendas);