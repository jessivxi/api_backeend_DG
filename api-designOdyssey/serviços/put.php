<?php
// Atualizar um serviço
require_once '../conexao.php'; // Inclui o arquivo de conexão com o banco de dados

$dados = json_decode(file_get_contents('php://input'), true); // Recebe os dados enviados no corpo da requisição (JSON)

// Verifica se o campo 'id' foi informado
if (!empty($dados['id'])) {
    // Prepara a query para atualizar o serviço com os dados informados
    $stmt = $pdo->prepare("UPDATE servicos SET titulo = ?, descricao = ?, categoria = ?, preco_base = ? WHERE id = ?");
    // Executa a query e verifica se foi bem-sucedida
    if ($stmt->execute([$dados['titulo'], $dados['descricao'], $dados['categoria'], $dados['preco_base'], $dados['id']])) {
        echo json_encode(['sucesso' => 'Serviço atualizado']); // Sucesso na atualização
    } else {
        echo json_encode(['erro' => 'Erro ao atualizar']); // Erro ao executar a query
    }
} else {
    echo json_encode(['erro' => 'ID não informado']); // ID não enviado
}
?>