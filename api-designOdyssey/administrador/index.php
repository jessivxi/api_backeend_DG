<?php

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Obtém o método HTTP da requisição (GET, POST, PUT, DELETE)
$metodo = $_SERVER['REQUEST_METHOD']; 
// Obtém o parâmetro 'rota' da URL, se existir, ou define como string vazia
$rota = $_GET['rota'] ?? '';
// Aqui poderia ser feita uma verificação de autenticação (comentário informativo)

// Estrutura de controle para direcionar a requisição conforme o método e rota
switch ("$metodo:$rota") {
    // Caso seja uma requisição POST para login de administrador
    case 'POST:login-admin':
        require 'auth/login-admin.php'; // Inclui o script de login do admin
        break;

    // Caso seja uma requisição GET para listar administradores
    case 'GET:admin':
        require 'admin/listar.php'; // Inclui o script para listar admins
        break;
    
    // Caso seja uma requisição POST para criar administrador
    case 'POST:admin':
        require 'admin/criar.php'; // Inclui o script para criar admin
        break;
    
    // Caso seja uma requisição PUT para atualizar administrador
    case 'PUT:admin':
        require 'admin/atualizar.php'; // Inclui o script para atualizar admin
        break;
    
    // Caso seja uma requisição DELETE para deletar administrador
    case 'DELETE:admin':
        require 'admin/deletar.php'; // Inclui o script para deletar admin
        break;

    // Caso nenhuma das rotas acima seja encontrada
    default:
        echo json_encode(['erro' => 'Rota não encontrada']); // Retorna erro em JSON
        http_response_code(404); // Define o código de resposta HTTP como 404
}

