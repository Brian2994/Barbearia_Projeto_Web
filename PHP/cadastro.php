<?php

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome  = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST ['confirmar_senha'] ?? '';

    if ($senha !== $confirmarSenha){
        echo "As senhas não coincidem.";
        exit;
    }

    $SenhaHash = password_hash($senha, PASSWORD_DEFAULT);


    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $SenhaHash);
        $stmt->execute();
        
        echo "Cadastro realizado com sucesso!";
    }
    catch (PDOException $e){
        echo "Erro ao cadastrar o usuario: " . $e->getMessage();
    }
    
}   else {
    echo "Método inválido.";
}
?>

