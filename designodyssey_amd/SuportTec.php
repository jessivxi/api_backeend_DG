<!-- filepath: c:\xampp\htdocs\tnet\designodyssey_amd\painel\SuportTec.php -->
<?php

include "navbar.php";

// Dados de exemplo (substitua por sua conexão com o banco)
$chamados = [
    [
        'id' => 1,
        'titulo' => 'Erro ao acessar o',
        'usuario' => 'João Silva',
        'data' => '10/05/2024',
        'prioridade' => 'Alta',
        'status' => 'Aberto',
        'descricao' => 'Não consigo acessar o site. Aparece erro 500.'
    ],
    [
        'id' => 2,
        'titulo' => 'Dúvida sobre pagamento',
        'usuario' => 'Maria Souza',
        'data' => '11/05/2024',
        'prioridade' => 'Média',
        'status' => 'Em andamento',
        'descricao' => 'Gostaria de saber se o pagamento já foi processado.'
    ],
    [
        'id' => 3,
        'titulo' => 'Solicitação de recurso',
        'usuario' => 'Carlos Souza',
        'data' => '12/05/2024',
        'prioridade' => 'Baixa',
        'status' => 'Resolvido',
        'descricao' => 'Seria possível adicionar um campo de observação nos pedidos?'
    ],
];

// Função para badge de prioridade
function prioridadeBadge($prioridade) {
    switch (strtolower($prioridade)) {
        case 'alta':
            return '<span class="badge rounded-pill prioridade-badge px-3 py-1" style="background:#ef4444;color:#fff;font-weight:600;font-size:0.95rem;border-width:1px;">Alta</span>';
        case 'média':
        case 'media':
            return '<span class="badge rounded-pill prioridade-badge px-3 py-1" style="background:#facc15;color:#1e293b;font-weight:600;font-size:0.95rem;border-width:1px;">Média</span>';
        case 'baixa':
            return '<span class="badge rounded-pill prioridade-badge px-3 py-1" style="background:#22c55e;color:#fff;font-weight:600;font-size:0.95rem;border-width:1px;">Baixa</span>';
        default:
            return '<span class="badge rounded-pill prioridade-badge px-3 py-1 bg-light text-dark" style="font-size:0.95rem;border-width:1px;">Indefinida</span>';
    }
}

// Função para badge de status
function statusBadge($status) {
    switch (strtolower($status)) {
        case 'aberto':
            return '<span class="badge rounded-pill status-badge px-3 py-1" style="background:#0096D1;color:#fff;font-weight:600;font-size:0.95rem;border-width:1px;">Aberto</span>';
        case 'em andamento':
            return '<span class="badge rounded-pill status-badge px-3 py-1" style="background:#facc15;color:#1e293b;font-weight:600;font-size:0.95rem;border-width:1px;">Em andamento</span>';
        case 'resolvido':
            return '<span class="badge rounded-pill status-badge px-3 py-1" style="background:#22c55e;color:#fff;font-weight:600;font-size:0.95rem;border-width:1px;">Resolvido</span>';
        default:
            return '<span class="badge rounded-pill status-badge px-3 py-1 bg-light text-dark" style="font-size:0.95rem;border-width:1px;">Desconhecido</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte Técnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
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
        .status-badge, .prioridade-badge {
            border-width: 1px !important;
            border-style: solid;
            border-color: transparent;
            letter-spacing: 1px;
            font-size: 0.95rem;
            padding: 0.35em 0.9em !important;
        }
        .btn-resolver {
            background: #22c55e;
            color: #fff;
            font-weight: 500;
            border: 1px solid #22c55e;
            padding: 4px 14px;
            border-radius: 6px;
            transition: background 0.2s, border 0.2s;
            font-size: 0.95rem;
            line-height: 1.2;
        }
        .btn-resolver:hover {
            background: #16a34a;
            border-color: #16a34a;
        }
        .check-azul {
            color: #0096D1;
            font-size: 1.3rem;
            vertical-align: middle;
        }
        /* Modal */
        .modal-chamado .modal-content {
            border-radius: 14px;
        }
        .modal-chamado .modal-header {
            background: #0096D1;
            color: #fff;
            border-radius: 14px 14px 0 0;
        }
        .modal-chamado .modal-title {
            font-weight: 600;
        }
        .modal-chamado .modal-body {
            background: #f8fafc;
        }
        @media (max-width: 600px) {
            .title_painel, .result_painel {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="painel_adm">
        <h1 class="title_painel">Suporte Técnico</h1>
        <p class="result_painel">Acompanhe e gerencie os chamados de suporte</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle shadow-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Usuário</th>
                        <th>Data</th>
                        <th>Prioridade</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($chamados as $chamado): ?>
                    <tr>
                        <td><?= $chamado['id'] ?></td>
                        <td>
                            <a href="#" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#modalChamado<?= $chamado['id'] ?>">
                                <?= htmlspecialchars($chamado['titulo']) ?>
                                <i class="bi bi-info-circle" style="color:#0096D1;font-size:1rem;" title="Ver detalhes"></i>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($chamado['usuario']) ?></td>
                        <td><?= $chamado['data'] ?></td>
                        <td><?= prioridadeBadge($chamado['prioridade']) ?></td>
                        <td><?= statusBadge($chamado['status']) ?></td>
                        <td>
                            <?php if (strtolower($chamado['status']) !== 'resolvido'): ?>
                                <button class="btn-resolver">
                                    Marcar como Resolvido
                                </button>
                            <?php else: ?>
                                <span class="check-azul"><i class="bi bi-patch-check-fill"></i></span>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- Modal de detalhes do chamado -->
                    <div class="modal fade modal-chamado" id="modalChamado<?= $chamado['id'] ?>" tabindex="-1" aria-labelledby="modalChamadoLabel<?= $chamado['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalChamadoLabel<?= $chamado['id'] ?>">
                                        <?= htmlspecialchars($chamado['titulo']) ?>
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Usuário:</strong> <?= htmlspecialchars($chamado['usuario']) ?></p>
                                    <p><strong>Data:</strong> <?= $chamado['data'] ?></p>
                                    <p><strong>Prioridade:</strong> <?= prioridadeBadge($chamado['prioridade']) ?></p>
                                    <p><strong>Status:</strong> <?= statusBadge($chamado['status']) ?></p>
                                    <hr>
                                    <p><strong>Descrição:</strong><br><?= nl2br(htmlspecialchars($chamado['descricao'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>