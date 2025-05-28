<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

// Verificar se é admin (simplificado)
if (!isset($_SERVER['HTTP_TOKEN']) || $_SERVER['HTTP_TOKEN'] !== 'TOKEN_ADMIN') {
    echo json_encode(['erro' => 'Acesso não autorizado']); // Retorna erro se não for admin
    exit; // Encerra o script
}

// Se foi enviado um id, busca apenas o usuário correspondente
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT id, nome, email, tipo, whatsapp FROM usuarios WHERE id = ?");
    $stmt->execute([$_GET['id']]);
} else {
    // Se não foi enviado id, busca todos os usuários
    $stmt = $pdo->query("SELECT id, nome, email, tipo, whatsapp FROM usuarios");
}

// Retorna o(s) usuário(s) em formato JSON
echo json_encode($stmt->fetchAll());
?>