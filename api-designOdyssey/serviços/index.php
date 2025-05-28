<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Obtém o método HTTP da requisição (GET, POST, PUT, DELETE)
$metodo = $_SERVER['REQUEST_METHOD'];
// Obtém o parâmetro 'rota' da URL, se existir, ou define como string vazia
$rota = $_GET['rota'] ?? '';

// Estrutura de controle para direcionar a requisição conforme o método e rota
switch ("$metodo:$rota") {
    // Caso seja uma requisição GET para listar serviços
    case 'GET:servicos':
        require 'servicos/listar.php'; // Inclui o script para listar serviços
        break;
    
    // Caso seja uma requisição POST para criar serviço
    case 'POST:servicos':
        require 'servicos/criar.php'; // Inclui o script para criar serviço
        break;
    
    // Caso seja uma requisição PUT para atualizar serviço
    case 'PUT:servicos':
        require 'servicos/atualizar.php'; // Inclui o script para atualizar serviço
        break;
    
    // Caso seja uma requisição DELETE para deletar serviço
    case 'DELETE:servicos':
        require 'servicos/deletar.php'; // Inclui o script para deletar serviço
        break;
    
    // Caso nenhuma das rotas acima seja encontrada
    default:
        echo json_encode(['erro' => 'Rota não encontrada']); // Retorna erro em JSON
        http_response_code(404); // Define o código de resposta HTTP como 404
}
?>