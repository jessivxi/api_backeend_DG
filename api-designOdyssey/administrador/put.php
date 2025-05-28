<?php
//atualiza um administrador
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

try {
    // Recebe os dados enviados no corpo da requisição (JSON)
    $dados = json_decode(file_get_contents('php://input'), true);

    // Verifica se o campo 'id' foi informado
    if (!empty($dados['id'])) {
        // Apenas admin principal ou o próprio admin pode atualizar
        $tokenValido = ($_SERVER['HTTP_TOKEN'] === 'TOKEN_ADMIN_PRINCIPAL') || 
                      ($_SERVER['HTTP_TOKEN'] === 'TOKEN_DO_ADMIN_' . $dados['id']);
        
        // Se o token não for válido, retorna erro de autorização
        if (!$tokenValido) {
            echo json_encode(['erro' => 'Acesso não autorizado']);
            exit;
        }

        // Array para armazenar os campos a serem atualizados
        $campos = [];
        // Array para armazenar os valores dos campos
        $valores = [];
        
        // Se o nome foi enviado, adiciona para atualização
        if (!empty($dados['nome'])) {
            $campos[] = "nome = ?";
            $valores[] = $dados['nome'];
        }
        
        // Se o status foi enviado, adiciona para atualização
        if (!empty($dados['status'])) {
            $campos[] = "status = ?";
            $valores[] = $dados['status'];
        }
        
        // Se há campos para atualizar
        if (!empty($campos)) {
            $valores[] = $dados['id']; // Adiciona o id ao final dos valores
            $sql = "UPDATE administradores SET " . implode(', ', $campos) . " WHERE id = ?";
            $stmt = $pdo->prepare($sql); // Prepara a query
            
            // Executa a query e verifica se foi bem-sucedida
            if ($stmt->execute($valores)) {
                echo json_encode(['sucesso' => 'Admin atualizado']);
            } else {
                echo json_encode(['erro' => 'Erro ao atualizar']);
            }
        } else {
            echo json_encode(['erro' => 'Nada para atualizar']); // Nenhum campo enviado
        }
    } else {
        echo json_encode(['erro' => 'ID não informado']); // ID não enviado
    }
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro no banco de dados: ' . $e->getMessage()]);
    http_response_code(500);
}
?>