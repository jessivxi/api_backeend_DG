<?php
// Deleta o usuário do banco de dados
require_once '../conexao.php'; // Inclui o arquivo de conexão com o banco de dados

$dados = json_decode(file_get_contents('php://input'), true); // Recebe os dados enviados no corpo da requisição (JSON)

// Verifica se o campo 'id' foi informado
if (!empty($dados['id'])) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?"); // Prepara a query para deletar o usuário
    if ($stmt->execute([$dados['id']])) {
        echo json_encode(['sucesso' => 'Usuário deletado']); // Sucesso na exclusão
    } else {
        echo json_encode(['erro' => 'Erro ao deletar']); // Erro ao executar a query
    }
} else {
    echo json_encode(['erro' => 'ID não informado']); // ID não enviado
}
?>