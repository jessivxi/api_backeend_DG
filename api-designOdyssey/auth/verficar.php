<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

// Verifica se o token foi enviado no header
if (!isset($_SERVER['HTTP_TOKEN'])) {
    echo json_encode(['valido' => false, 'erro' => 'Token não fornecido']);
    http_response_code(401);
    exit;
}

$token = $_SERVER['HTTP_TOKEN'];

// Verificação simples para admin principal
if ($token === 'TOKEN_ADMIN_PRINCIPAL') {
    echo json_encode(['valido' => true, 'tipo' => 'admin']);
    exit;
}

// Verificação para admin comum
if (strpos($token, 'TOKEN_DO_ADMIN_') === 0) {
    // Extrai o ID do admin do token
    $id = str_replace('TOKEN_DO_ADMIN_', '', $token);
    $stmt = $pdo->prepare("SELECT id FROM administradores WHERE id = ? AND status = 'ativo'");
    $stmt->execute([$id]);
    if ($stmt->fetch()) {
        echo json_encode(['valido' => true, 'tipo' => 'admin']);
        exit;
    }
}

// Verificação para usuário comum (exemplo usando base64)
if (base64_decode($token, true)) {
    $dados = explode(':', base64_decode($token));
    if (count($dados) === 2) {
        $email = $dados[0];
        $id = $dados[1];
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE id = ? AND email = ?");
        $stmt->execute([$id, $email]);
        if ($stmt->fetch()) {
            echo json_encode(['valido' => true, 'tipo' => 'usuario']);
            exit;
        }
    }
}

// Se não passou em nenhuma verificação
echo json_encode(['valido' => false, 'erro' => 'Token inválido']);
http_response_code(401);
?>