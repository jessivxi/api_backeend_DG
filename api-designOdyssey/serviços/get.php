<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

// Listar todos os serviços ou um específico, dependendo do parâmetro 'id'
if (isset($_GET['id'])) {
    // Se o parâmetro 'id' foi enviado, busca apenas o serviço correspondente
    $stmt = $pdo->prepare("SELECT * FROM servicos WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $resultado = $stmt->fetch();
} else {
    // Se não foi enviado 'id', busca todos os serviços
    $stmt = $pdo->query("SELECT * FROM servicos");
    $resultado = $stmt->fetchAll();
}

// Retorna o resultado em formato JSON
echo json_encode($resultado);
?>