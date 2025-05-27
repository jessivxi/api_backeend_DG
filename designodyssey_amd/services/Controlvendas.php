<?php
    include "navbar.php";

    // Exemplo de dados (pode substituir por consulta ao banco)
    $vendas = [
        [
            'id' => 1,
            'item' => 'Design Gráfico',
            'popularidade' => 'alta',
            'status' => 'entregue'
        ],
        [
            'id' => 2,
            'item' => 'Desenvolvimento Web',
            'popularidade' => 'baixa',
            'status' => 'pendente'
        ],
        [
            'id' => 3,
            'item' => 'Desenvolvimento de logo',
            'popularidade' => 'alta',
            'status' => 'nao-iniciado'
        ],
        [
            'id' => 4,
            'item' => 'Interface para site',
            'popularidade' => 'baixa',
            'status' => 'entregue'
        ],
        [
            'id' => 5,
            'item' => 'Criação de identidade visual',
            'popularidade' => 'alta',
            'status' => 'pendente'
        ]
    ];

    function statusBadge($status) {
        switch ($status) {
            case 'entregue':
                return '<span class="badge rounded-pill px-3 py-2" style="background:#0096D1;color:#fff;font-weight:600;"><i class="bi bi-check-circle"></i> ENTREGUE</span>';
            case 'pendente':
                return '<span class="badge rounded-pill px-3 py-2" style="background:#facc15;color:#1e293b;font-weight:600;"><i class="bi bi-hourglass"></i> PENDENTE</span>';
            case 'nao-iniciado':
                return '<span class="badge rounded-pill px-3 py-2" style="background:#64748b;color:#fff;font-weight:600;"><i class="bi bi-dash-circle"></i> NÃO INICIADO</span>';
            default:
                return '<span class="badge rounded-pill bg-light text-dark px-3 py-2">DESCONHECIDO</span>';
        }
    }

    function popularidadeIcon($popularidade) {
        if ($popularidade === 'alta') {
            return '<span class="popularidade-alta"><i class="bi bi-graph-up-arrow"></i> Em alta</span>';
        } else {
            return '<span class="popularidade-baixa"><i class="bi bi-graph-down-arrow"></i> Baixa Popularidade</span>';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Vendas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
            color:rgb(0, 0, 0);
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
        .popularidade-alta {
            color: #22c55e;
            font-weight: 600;
        }
        .popularidade-baixa {
            color: #ef4444;
            font-weight: 600;
        }
        .badge i, .popularidade-alta i, .popularidade-baixa i {
            margin-right: 4px;
        }
    </style>
</head>
<body>
    <div class="painel_adm">
        <h1 class="title_painel">Controle de Vendas</h1>
        <p class="result_painel">Gerencie as vendas realizadas e seus status</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle shadow-sm">
                <thead>
                    <tr>
                        <th>ID Produto</th>
                        <th>Item</th>
                        <th>Popularidade</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendas as $venda): ?>
                    <tr>
                        <td><?= $venda['id'] ?></td>
                        <td><?= htmlspecialchars($venda['item']) ?></td>
                        <td><?= popularidadeIcon($venda['popularidade']) ?></td>
                        <td><?= statusBadge($venda['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>