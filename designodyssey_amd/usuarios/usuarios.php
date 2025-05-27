<?php
include "navbar.php";

// Dados de exemplo (substitua por sua conexão com o banco)
$users = [
    ['id' => 1, 'nome' => 'João Silva', 'email' => 'joao@exemplo.com', 'data' => '10/05/2024', 'tipo' => 'Freelancer'],
    ['id' => 2, 'nome' => 'Maria Souza', 'email' => 'maria@exemplo.com', 'data' => '11/05/2024', 'tipo' => 'Cliente'],
    ['id' => 3, 'nome' => 'Carlos Souza', 'email' => 'carlos@exemplo.com', 'data' => '12/05/2024', 'tipo' => 'Freelancer'],
    ['id' => 4, 'nome' => 'Maria Lucia', 'email' => 'MAria@exemplo.com', 'data' => '21/05/2024', 'tipo' => 'Cliente'],
    ['id' => 5, 'nome' => 'Carlos Souza', 'email' => 'carlos@exemplo.com', 'data' => '30/05/2024', 'tipo' => 'Freelancer']
];

// Se a requisição for GET e pedir JSON, retorna os dados em JSON
if (
    $_SERVER['REQUEST_METHOD'] === 'GET' &&
    (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
) {
    header('Content-Type: application/json');
    echo json_encode($users);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: white;
            min-height: 100vh;
        }
        .painel_adm {
            margin: 32px auto 0 auto;
            max-width: 1100px;
            padding: 30px 0 10px 0;
        }
        .title_painel {
            font-size: 2.2rem;
            font-weight: 700;
            color:rgb(0, 0, 0);
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
            text-align: left;
        }
        .result_painel {
            color: rgb(168, 165, 165);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }
        .table-responsive {
            margin: 0 auto;
            max-width: 1100px;
        }
        .table {
            background: #f3f4f6;
            border-radius: 12px;
            overflow: hidden;
        }
        .table thead th {
            background: #e5e7eb;
            color: #22223b;
            font-size: 1rem;
            letter-spacing: 1px;
            border-bottom: 2px solid #d1d5db;
        }
        .table tbody tr {
            transition: background 0.2s;
        }
        .table tbody tr:hover {
            background: #e0e7ef;
        }
        .btn-edit {
            background: #0096D1;
            color: #fff;
            font-weight: 500;
            border: none;
            padding: 5px 14px;
            border-radius: 6px;
            margin-right: 6px;
            transition: background 0.2s;
        }
        .btn-edit:hover {
            background:rgb(8, 165, 228);
        }
        .btn-delete {
            background: #ef4444;
            color: #fff;
            font-weight: 500;
            border: none;
            padding: 5px 14px;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .btn-delete:hover {
            background: #b91c1c;
        }
    </style>
</head>
<body>
    <div class="painel_adm">
        <h1 class="title_painel">Gerenciador de Usuários</h1>
        <p class="result_painel">Lista de usuários cadastrados no sistema</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle shadow-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data de Cadastro</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php require_once("../requests/usuarios/get.php"); ?>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['nome']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= $user['data'] ?></td>
                        <td><?= $user['tipo'] ?></td>
                        <td>
                            <button class="btn-edit">Editar</button>
                            <button class="btn-delete">Excluir</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
