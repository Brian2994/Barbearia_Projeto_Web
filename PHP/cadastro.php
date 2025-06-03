<?php
ob_start();

require_once 'conexao.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome  = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST ['confirmar_senha'] ?? '';

    if ($senha !== $confirmarSenha){
        $erro = "As senhas não coincidem.";
    } elseif (empty($nome) || empty($email) || empty($senha) || empty($confirmarSenha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $existe = $stmt->fetchColumn();

        if ($existe > 0) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
            $SenhaHash = password_hash($senha, PASSWORD_DEFAULT);
            try {
                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $SenhaHash);
                $stmt->execute();

                header("Location: formulario.php");
                exit;
            } catch (PDOException $e){
                $erro = "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    }
}
?>
