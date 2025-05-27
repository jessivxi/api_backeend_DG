<?php
include "navbar.php";

// Dados de exemplo (substitua pela sua conexão com o banco)
$services = [
    ['id' => 1, 'nome' => 'João Silva', 'servico' => 'Design Gráfico', 'status' => 'entregue'],
    ['id' => 2, 'nome' => 'Maria Oliveira', 'servico' => 'Desenvolvimento Web', 'status' => 'pendente'],
    ['id' => 3, 'nome' => 'Carlos Souza', 'servico' => 'Logo para loja', 'status' => 'nao-iniciado'],
    ['id' => 4, 'nome' => 'Ana Santos', 'servico' => 'Interface para site', 'status' => 'nao-entregue'],
];

// Função para retornar badge colorido do status
function statusBadge($status) {
    switch ($status) {
        case 'entregue':
            return '<span class="badge rounded-pill px-3 py-2" style="background:#0096D1;color:#fff;font-weight:600;"><i class="bi bi-check-circle"></i> ENTREGUE</span>';
        case 'pendente':
            return '<span class="badge rounded-pill px-3 py-2" style="background:#facc15;color:#1e293b;font-weight:600;"><i class="bi bi-hourglass-split"></i> PENDENTE</span>';
        case 'nao-entregue':
            return '<span class="badge rounded-pill px-3 py-2" style="background:#ef4444;color:#fff;font-weight:600;"><i class="bi bi-x-circle"></i> NÃO ENTREGUE</span>';
        case 'nao-iniciado':
            return '<span class="badge rounded-pill px-3 py-2" style="background:#64748b;color:#fff;font-weight:600;"><i class="bi bi-dash-circle"></i> NÃO INICIADO</span>';
        default:
            return '<span class="badge rounded-pill bg-light text-dark px-3 py-2">DESCONHECIDO</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Serviços</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background:white;
            min-height: 100vh;
        }
        .painel_adm {
            margin: 32px auto 0 auto;
            max-width: 1100px;
            padding: 30px 0 10px 0;
        }
        .title_painel {
            font-size: 2.1rem;
            font-weight: 700;
            color:black;
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
            text-align: left;
        }
        .result_painel {
            color:rgb(168, 165, 165);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }
        .table-responsive {
            margin: 0 auto;
            max-width: 1100px;
        }
        .table {
            border-radius: 12px;
            overflow: hidden;
        }
        .table thead th {
            background: #e5e7eb;
            color:rgb(0, 0, 0);
            font-size: 1rem;
            letter-spacing: 1px;
            border-bottom: 2px solidrgb(183, 183, 184);
        }
        .table tbody tr:hover {
            background:rgb(231, 231, 231);
        }
        .badge i {
            margin-right: 4px;
        }
    </style>
</head>
<body>
    <div class="painel_adm">
        <h1 class="title_painel"> Controle de Serviços</h1>
        <p class="result_painel">Status atual dos serviços dos clientes e freelancers</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle shadow-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Serviço</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $servico): ?>
                    <tr>
                        <td><?= $servico['id'] ?></td>
                        <td><?= htmlspecialchars($servico['nome']) ?></td>
                        <td><?= htmlspecialchars($servico['servico']) ?></td>
                        <td><?= statusBadge($servico['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>