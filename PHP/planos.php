<?php
require_once 'conexao.php'; 

$planos = [
    ['nome' => 'Plano Corte de Cabelo Mensal', 'descricao' => 'Cortes ilimitados', 'preco' => 79.90],
    ['nome' => 'Plano Corte de Barba Mensal', 'descricao' => '4 cortes por mês', 'preco' => 59.90],
    ['nome' => 'Plano Luxo Mensal', 'descricao' => 'Cortes Ilimitados + Barba ilimitada', 'preco' => 129.90],
];

try {
    $pdo->beginTransaction();

    foreach ($planos as $plano) {
        $stmt = $pdo->prepare("INSERT INTO planos (nome, descricao, preco) VALUES (:nome, :descricao, :preco)");
        $stmt->execute([
            ':nome' => $plano['nome'],
            ':descricao' => $plano['descricao'],
            ':preco' => $plano['preco']
        ]);
    }

    $pdo->commit();
    echo "Planos inseridos com sucesso!";
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Erro ao inserir os planos: " . $e->getMessage();
}

