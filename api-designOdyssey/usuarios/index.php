<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Obtém o método HTTP da requisição (GET, POST, PUT, DELETE)
$metodo = $_SERVER['REQUEST_METHOD'];
// Obtém o parâmetro 'rota' da URL, se existir, ou define como string vazia
$rota = $_GET['rota'] ?? '';

// Rotas públicas: permite login sem autenticação
if ($metodo === 'POST' && $rota === 'login') {
    require 'auth/login.php'; // Inclui o script de login do usuário
    exit; // Encerra o script após o login
}

// Verificação simplificada de autenticação: exige token no header
if (!isset($_SERVER['HTTP_TOKEN'])) {
    echo json_encode(['erro' => 'Token não fornecido']); // Retorna erro se não houver token
    http_response_code(401); // Define o código HTTP como 401 (não autorizado)
    exit; // Encerra o script
}

// Rotas protegidas: só acessa se autenticado
switch ("$metodo:$rota") {
    // Usuários
    case 'GET:usuarios':
        require 'usuarios/listar.php'; // Lista usuários
        break;
    case 'POST:usuarios':
        require 'usuarios/criar.php'; // Cria novo usuário
        break;
    case 'PUT:usuarios':
        require 'usuarios/atualizar.php'; // Atualiza usuário
        break;
    case 'DELETE:usuarios':
        require 'usuarios/deletar.php'; // Deleta usuário
        break;
    
    // Caso nenhuma das rotas acima seja encontrada
    default:
        echo json_encode(['erro' => 'Rota não encontrada']); // Retorna erro em JSON
        http_response_code(404); // Define o código HTTP como 404
}
?>