<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

// Recebe os dados enviados no corpo da requisição (JSON)
$dados = json_decode(file_get_contents('php://input'), true);

// Verifica se os campos obrigatórios foram preenchidos
if (!empty($dados['email']) && !empty($dados['senha'])) {
    // Prepara a query para buscar o admin pelo email e status ativo
    $stmt = $pdo->prepare("SELECT id, nome, email, senha, nivel_acesso FROM administradores WHERE email = ? AND status = 'ativo'");
    $stmt->execute([$dados['email']]);
    $admin = $stmt->fetch();
    
    // Verifica se encontrou o admin e se a senha está correta
    if ($admin && password_verify($dados['senha'], $admin['senha'])) {
        // Gera um token simplificado (em produção use JWT)
        $token = 'TOKEN_DO_ADMIN_' . $admin['id'];
        // Se for admin principal, define token especial
        if ($admin['nivel_acesso'] === 'admin') {
            $token = 'TOKEN_ADMIN_PRINCIPAL';
        }
        
        // Retorna resposta de sucesso com token e dados do admin
        echo json_encode([
            'sucesso' => 'Login realizado',
            'token' => $token,
            'admin' => [
                'id' => $admin['id'],
                'nome' => $admin['nome'],
                'nivel' => $admin['nivel_acesso']
            ]
        ]);
    } else {
        // Credenciais inválidas ou conta inativa
        echo json_encode(['erro' => 'Credenciais inválidas ou conta inativa']);
    }
} else {
    // Dados obrigatórios não enviados
    echo json_encode(['erro' => 'Dados incompletos']);
}
?>