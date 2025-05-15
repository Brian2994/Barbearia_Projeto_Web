<?php 
$host = 'mysql';
$db = 'projeto';
$user = 'teste';
$pass = 'testesenha123';

$logFile = __DIR__ . '/logs/erro_conexao.log';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "<h2 style='color:green;'>Conexão com o banco de dados bem sucedida.</h2>"; (Caso for ser usado para teste.)
}
catch (PDOException $e){
    $mensagemerro = "[" . date('d/m/Y H:i:s') . "] Erro de conexão: " . $e->getMessage() . PHP_EOL;
    
    if (!file_exists(__DIR__ . '/logs')){
        mkdir(__DIR__ . '/logs', 0777, true);
    }
    file_put_contents($logFile, $mensagemerro, FILE_APPEND);
    echo "<h2 style='color:red;>Erro interno ao tentar se conectar ao banco de dados.</h2>";
}



