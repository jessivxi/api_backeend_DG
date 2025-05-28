<?php
//deleta um administrador
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

try {
    // Recebe os dados enviados no corpo da requisição (JSON)
    $dados = json_decode(file_get_contents('php://input'), true);

    // Apenas admin principal pode deletar administradores
    if (!isset($_SERVER['HTTP_TOKEN']) || $_SERVER['HTTP_TOKEN'] !== 'TOKEN_ADMIN_PRINCIPAL') {
        echo json_encode(['erro' => 'Acesso não autorizado']); // Retorna erro de autorização
        exit; // Encerra o script
    }

    // Verifica se o campo 'id' foi informado
    if (!empty($dados['id'])) {
        $stmt = $pdo->prepare("DELETE FROM administradores WHERE id = ?"); // Prepara a query de exclusão
        if ($stmt->execute([$dados['id']])) {
            echo json_encode(['sucesso' => 'Admin deletado']); // Sucesso na exclusão
        } else {
            echo json_encode(['erro' => 'Erro ao deletar']); // Erro ao executar a query
        }
    } else {
        echo json_encode(['erro' => 'ID não informado']); // ID não enviado
    }
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro no banco de dados: ' . $e->getMessage()]);
    http_response_code(500);
}
?>