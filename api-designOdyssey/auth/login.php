<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

// Recebe os dados enviados no corpo da requisição (JSON)
$dados = json_decode(file_get_contents('php://input'), true);

// Verifica se os campos obrigatórios foram preenchidos
if (!empty($dados['email']) && !empty($dados['senha'])) {
    // Prepara a query para buscar o usuário pelo email
    $stmt = $pdo->prepare("SELECT id, nome, email, senha, tipo FROM usuarios WHERE email = ?");
    $stmt->execute([$dados['email']]);
    $usuario = $stmt->fetch();
    
    // Verifica se encontrou o usuário e se a senha está correta
    if ($usuario && password_verify($dados['senha'], $usuario['senha'])) {
        // Gera um token simplificado (em produção use JWT)
        $token = base64_encode($usuario['email'] . ':' . $usuario['id']);
        // Retorna resposta de sucesso com token e dados do usuário
        echo json_encode([
            'sucesso' => 'Login realizado',
            'token' => $token,
            'usuario' => [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'tipo' => $usuario['tipo']
            ]
        ]);
    } else {
        // Credenciais inválidas
        echo json_encode(['erro' => 'Credenciais inválidas']);
    }
} else {
    // Dados obrigatórios não enviados
    echo json_encode(['erro' => 'Dados incompletos']);
}
?>