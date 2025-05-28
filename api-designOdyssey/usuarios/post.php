<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

// Recebe os dados enviados no corpo da requisição (JSON)
$dados = json_decode(file_get_contents('php://input'), true);

// Verifica se os campos obrigatórios foram preenchidos
if (!empty($dados['nome']) && !empty($dados['email']) && !empty($dados['senha'])) {
    // Gera o hash da senha informada
    $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
    
    // Prepara a query para inserir um novo usuário no banco
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo, whatsapp) VALUES (?, ?, ?, ?, ?)");
    // Executa a query e verifica se foi bem-sucedida
    if ($stmt->execute([
        $dados['nome'], // Nome do usuário
        $dados['email'], // Email do usuário
        $senhaHash, // Senha já criptografada
        $dados['tipo'] ?? 'cliente', // Tipo do usuário, padrão 'cliente'
        $dados['whatsapp'] ?? '' // WhatsApp, se informado
    ])) {
        echo json_encode(['sucesso' => 'Usuário criado com ID: ' . $pdo->lastInsertId()]); // Sucesso na criação
    } else {
        echo json_encode(['erro' => 'Erro ao criar usuário']); // Erro ao executar a query
    }
} else {
    echo json_encode(['erro' => 'Dados incompletos']); // Dados obrigatórios não enviados
}
?>