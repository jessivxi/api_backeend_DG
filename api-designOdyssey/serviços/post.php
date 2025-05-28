<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

// Recebe os dados enviados no corpo da requisição (JSON)
$dados = json_decode(file_get_contents('php://input'), true);

// Verifica se os campos obrigatórios foram preenchidos
if (!empty($dados['titulo']) && !empty($dados['descricao'])) {
    // Prepara a query para inserir um novo serviço no banco
    $stmt = $pdo->prepare("INSERT INTO servicos (titulo, descricao, categoria, preco_base) VALUES (?, ?, ?, ?)");
    // Executa a query e verifica se foi bem-sucedida
    if ($stmt->execute([$dados['titulo'], $dados['descricao'], $dados['categoria'], $dados['preco_base']])) {
        echo json_encode(['sucesso' => 'Serviço criado com ID: ' . $pdo->lastInsertId()]); // Sucesso na criação
    } else {
        echo json_encode(['erro' => 'Erro ao criar serviço']); // Erro ao executar a query
    }
} else {
    echo json_encode(['erro' => 'Dados incompletos']); // Dados obrigatórios não enviados
}
?>