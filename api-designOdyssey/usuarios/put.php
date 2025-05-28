<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

// Recebe os dados enviados no corpo da requisição (JSON)
$dados = json_decode(file_get_contents('php://input'), true);

// Verifica se o campo 'id' foi informado
if (!empty($dados['id'])) {
    $campos = []; // Array para armazenar os campos a serem atualizados
    $valores = []; // Array para armazenar os valores dos campos
    
    // Se o nome foi enviado, adiciona para atualização
    if (!empty($dados['nome'])) {
        $campos[] = "nome = ?";
        $valores[] = $dados['nome'];
    }
    
    // Se o whatsapp foi enviado, adiciona para atualização
    if (!empty($dados['whatsapp'])) {
        $campos[] = "whatsapp = ?";
        $valores[] = $dados['whatsapp'];
    }
    
    // Se há campos para atualizar
    if (!empty($campos)) {
        $valores[] = $dados['id']; // Adiciona o id ao final dos valores
        $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql); // Prepara a query
        
        // Executa a query e verifica se foi bem-sucedida
        if ($stmt->execute($valores)) {
            echo json_encode(['sucesso' => 'Usuário atualizado']); // Sucesso na atualização
        } else {
            echo json_encode(['erro' => 'Erro ao atualizar']); // Erro ao executar a query
        }
    } else {
        echo json_encode(['erro' => 'Nada para atualizar']); // Nenhum campo enviado
    }
} else {
    echo json_encode(['erro' => 'ID não informado']); // ID não enviado
}
?>