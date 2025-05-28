<?php
//cria um novo administrador
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

try {
    // Recebe os dados enviados no corpo da requisição (JSON)
    $dados = json_decode(file_get_contents('php://input'), true);

    // Verifica se os campos obrigatórios foram preenchidos
    if (!empty($dados['nome']) && !empty($dados['email']) && !empty($dados['senha'])) {
        // Verifica se o token de admin principal foi fornecido corretamente
        if (!isset($_SERVER['HTTP_TOKEN']) || $_SERVER['HTTP_TOKEN'] !== 'TOKEN_ADMIN_PRINCIPAL') {
            echo json_encode(['erro' => 'Acesso não autorizado']); // Retorna erro de autorização
            exit; // Encerra o script
        }

        // Gera o hash da senha informada (a senha nunca é salva em texto puro, apenas o hash seguro)
        $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
        //o hash é gerado usando o algoritmo padrão do PHP, que é seguro e recomendado
        //o hash ja faz criptografia da senha, então não é necessário fazer mais nada com ela
        
        // Prepara a query para inserir novo administrador no banco
        $stmt = $pdo->prepare("INSERT INTO administradores (nome, email, senha, nivel_acesso) VALUES (?, ?, ?, ?)");
        //pdo executa a query com os dados fornecidos(pdo = uma classe do PHP que facilita a conexão com o banco de dados)
        // A query insere o nome, email, senha (já criptografada) e nível de acesso do novo administrador
        // O nível de acesso é opcional, se não for informado, será definido como 'suporte' por padrão
        // O nível de acesso pode ser 'admin', 'suporte' ou outro definido pelo sistema
        // O nível de acesso é importante para definir as permissões do administrador no sistema
        // O PDO prepara a query para evitar SQL Injection, que é uma técnica de ataque onde o invasor tenta manipular a consulta SQL

        if ($stmt->execute([
            // Os valores são passados na ordem correta para os placeholders da query (placeholders são os pontos de interrogação na query)
            // Os placeholders são substituídos pelos valores correspondentes na execução da query
            //a query e responsável por inserir os dados do novo administrador no banco de dados
            $dados['nome'], // Nome do novo admin
            $dados['email'], // Email do novo admin
            $senhaHash, // Senha já criptografada (hash seguro gerado acima)
            $dados['nivel_acesso'] ?? 'suporte' // Nível de acesso, padrão 'suporte'
        ])) {
            echo json_encode(['sucesso' => 'Admin criado com ID: ' . $pdo->lastInsertId()]); // Sucesso na criação
        } else {
            echo json_encode(['erro' => 'Erro ao criar admin']); // Erro ao inserir no banco
        }
    } else {
        echo json_encode(['erro' => 'Dados incompletos']); // Dados obrigatórios não enviados
    }
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro no banco de dados: ' . $e->getMessage()]);
    http_response_code(500);
}
?>