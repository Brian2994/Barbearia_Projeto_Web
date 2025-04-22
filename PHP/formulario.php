<?php
$host = 'mysql';
$db = 'projeto';
$user = 'teste';
$pass = 'testesenha123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    echo "<h2 style='color:green;'>Conexão com o banco de dados bem sucedida.</h2>";
} 
catch (PDOException $e) {
    echo "<h2 style='color:red;'>Erro na conexão: " . $e->getMessage() . "</h2>";
}
?>

