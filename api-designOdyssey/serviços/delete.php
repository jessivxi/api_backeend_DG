<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';
// Recebe os dados enviados no corpo da requisição (JSON)
$dados = json_decode(file_get_contents('php://input'), true);

// Verifica se o campo 'id' foi informado
if (!empty($dados['id'])) {
    // Prepara a query para deletar o serviço com o id informado
    $stmt = $pdo->prepare("DELETE FROM servicos WHERE id = ?");
    // Executa a query e verifica se foi bem-sucedida
    if ($stmt->execute([$dados['id']])) {
        echo json_encode(['sucesso' => 'Serviço deletado']); // Sucesso na exclusão
    } else {
        echo json_encode(['erro' => 'Erro ao deletar']); // Erro ao executar a query
    }
} else {
    echo json_encode(['erro' => 'ID não informado']); // ID não enviado
}
?>