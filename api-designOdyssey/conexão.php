<?php
// Configurações do banco de dados
$host = 'localhost'; // Endereço do servidor MySQL
$db   = 'design_odyssey'; // Nome do banco de dados
$user = 'root'; // Usuário do banco de dados
$pass = ''; // Senha do banco de dados

// Cria a conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass); // Instancia o objeto PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define o modo de erro para exceções
} catch (PDOException $e) {
    // Em caso de erro na conexão, exibe a mensagem e encerra o script
    die("Erro de conexão: " . $e->getMessage());
}
?>