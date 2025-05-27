<?php
    include "navbar.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="painel_adm">
    </div>
    <div class="boxes_adm_main">
        <!-- Gerenciamento de Usuário -->
        <div class="box_gerencer_color_red">
            <p class="number_gerencer">
                44 <i class="bi bi-person-fill-check"></i>
            </p>
            <p class="title_gerencer">Gerenciamento de usuário</p>
        </div>
        <!-- Controle de Serviços -->
        <div class="box_service_color_blue">
            <p class="number_service">
                44 <i class="bi bi-person-bounding-box"></i>
            </p>
            <p class="title_service">Controle de serviços</p>
        </div>
        <!-- Controle de Vendas -->
        <div class="box_control_color_yellow">
            <p class="number_control">
                44 <i class="bi bi-bar-chart-fill"></i>
            </p>
            <p class="title_control">Controle de vendas</p>
        </div>
        <!-- Suporte Técnico -->
        <div class="box_suport_color_green">
            <p class="number_suport">
            <i class="bi bi-headset"></i>
            </p>
            <p class="title_suport">Suporte Técnico</p>
        </div>
    </div>

    <!-- Painel de Calendário, Gráfico e Lista - calendário e gráfico lado a lado, alinhados com as boxes coloridas -->
    <div class="painel-inferior-container">
        <div class="painel-row-cg">
            <!-- Calendário -->
            <div class="card card-calendario shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-semibold" style="font-size:1.1rem;">Calendário</span>
                        <button class="btn btn-sm btn-primary" onclick="editarCalendario()" title="Editar calendário">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <?php
                        $eventos = [
                            3 => ['manutencao', 'Manutenção programada'],
                            12 => ['manutencao', 'Manutenção programada'],
                            18 => ['manutencao', 'Manutenção programada'],
                        ];
                        $mes = date('n');
                        $ano = date('Y');
                        $diasSemana = ['D','S','T','Q','Q','S','S'];
                        $diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
                        $primeiroDiaSemana = date('w', strtotime("$ano-$mes-01"));
                        $hoje = date('j');
                        echo '<table class="table table-bordered text-center align-middle mb-0" style="font-size:1rem;background:#fff;max-width:320px;margin:0 auto;">';
                        echo '<thead class="table-light"><tr>';
                        foreach ($diasSemana as $d) echo "<th class='fw-bold text-primary' style='padding:4px 8px;'>$d</th>";
                        echo '</tr></thead><tbody><tr>';
                        for ($i = 0; $i < $primeiroDiaSemana; $i++) echo "<td></td>";
                        for ($dia = 1; $dia <= $diasNoMes; $dia++) {
                            $classe = ($dia == $hoje) ? "bg-primary text-white fw-bold rounded-circle" : "";
                            echo "<td class='$classe' style='padding:8px 0;width:38px;height:38px;'>";
                            echo $dia;
                            if (isset($eventos[$dia]) && $eventos[$dia][0] == 'manutencao') {
                                echo " <i class='bi bi-tools text-danger' title='{$eventos[$dia][1]}'></i>";
                            }
                            echo "</td>";
                            if (($primeiroDiaSemana + $dia) % 7 == 0) echo "</tr><tr>";
                        }
                        echo '</tr></tbody></table>';
                        ?>
                    </div>
                </div>
            </div>
            <!-- Gráfico -->
            <div class="card card-grafico shadow-sm h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center">
                    <span class="fw-semibold mb-2" style="font-size:1.1rem;">Gráfico</span>
                    <div style="width:100%;max-width:320px;">
                        <canvas id="miniChart" width="300" height="160"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Lista de Tarefas embaixo -->
        <div class="painel-row-lista">
            <div class="card card-lista-tarefas shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-semibold" style="font-size:1.1rem;">Lista de Tarefas</span>
                        <button class="btn btn-sm btn-warning" onclick="alterarTarefas()" title="Alterar tarefas">
                            <i class="bi bi-gear"></i> Alterações
                        </button>
                    </div>
                    <ul class="list-group list-group-flush mt-2" style="font-size:1.08rem;">
                        <li class="list-group-item py-2 px-3">Reunião <span class="badge bg-success ms-2">Hoje</span></li>
                        <li class="list-group-item py-2 px-3">Enviar relatório <span class="badge bg-warning text-dark ms-2">Pendente</span></li>
                        <li class="list-group-item py-2 px-3">Backup <span class="badge bg-danger ms-2">Urgente</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráfico pequeno
        document.addEventListener("DOMContentLoaded", function() {
            new Chart(document.getElementById('miniChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Jan','Fev','Mar','Abr'],
                    datasets: [{
                        label: 'Vendas',
                        data: [4, 7, 3, 6],
                        backgroundColor: '#1976d2'
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { ticks: { color: '#222', font: { size: 10 } } },
                        y: { beginAtZero: true, ticks: { color: '#222', font: { size: 10 } } }
                    }
                }
            });
        });

        // Botão editar calendário
        function editarCalendario() {
            alert('Função de editar calendário: aqui o admin pode marcar ou alterar dias de manutenção.');
        }
        // Botão de alterações da lista de tarefas
        function alterarTarefas() {
            alert('Função de alteração de tarefas: aqui o admin pode editar a lista de tarefas.');
        }
    </script>
    <style>
        /* Estilo geral do painel */
        body {
            background: rgb(255, 255, 255);
            font-family: Arial, sans-serif;
            color: #222;
        }
        .painel_adm {
            margin: 32px auto 0 auto;
            padding: 30px 0 10px 0;
        }

        /* Container das boxes coloridas */
        .boxes_adm_main {
            display: flex;
            flex-wrap: nowrap;
            justify-content: center;
            align-items: stretch;
            gap: 24px;
            max-width: 1100px;
            margin: 0 auto 24px auto;
        }

        /* Caixas coloridas alinhadas com calendário e gráfico */
        .box_gerencer_color_red,
        .box_service_color_blue,
        .box_control_color_yellow,
        .box_suport_color_green {
            display: flex;
            width: 320px;
            min-width: 260px;
            max-width: 380px;
            height: 120px;
            border-radius: 10px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px #0001;
            font-size: 1.05rem;
            transition: transform 0.15s;
            float: none;
        }

        /* Cores das boxes */
        .box_gerencer_color_red {
            background: #ef4444;
            color: #fff;
        }
        .box_service_color_blue {
            background: #3b82f6;
            color: #fff;
        }
        .box_control_color_yellow {
            background: rgb(255, 220, 45);
            color: #222;
        }
        .box_suport_color_green {
            background: #22c55e;
            color: #fff;
        }

        /* Padroniza o conteúdo da caixa de suporte */
        .box_suport_color_green .title_suport {
            font-size: 1.0rem;
            font-weight: bold;
            text-align: center;
            color: white;
            margin-bottom: 0.2rem;
            line-height: 1.1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .box_suport_color_green i {
            display: block;
            font-size: 1.6rem;
            margin-top: 2px;
        }

        /* Títulos das boxes coloridas: texto e ícone lado a lado */
        .title_gerencer,
        .title_service,
        .title_control,
        .title_suport {
            font-size: 1.0rem;
            font-weight: bold;
            text-align: center;
            color: white;
            margin-bottom: 0;
            line-height: 1.1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1px; /* Espaço entre texto e ícone */
        }

        /* Ícones ao lado do texto, não embaixo */
        .title_gerencer i,
        .title_service i,
        .title_control i,
        .title_suport i {
            display: inline-block;
            font-size: 1.3rem;
            margin-top: 0;
            margin-left: 4px;
        }

        /* Números das boxes */
        .number_gerencer,
        .number_service,
        .number_control {
            font-size: 2rem;
            color: white;
            font-weight: bold;
            margin-bottom: 0.05rem;
        }
      /* Ajuste para o número e ícone do suporte ficarem alinhados */
        .number_suport {
            font-size: 2rem;
            color: white;
            font-weight: bold;
            margin-bottom: 0.05rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        /* Cartões do calendário, gráfico e lista: alinhados com as boxes coloridas (maiores) */
        .card-calendario {
            min-width: 520px;
            max-width: 380px;
            width: 340px;
            box-shadow: 0 2px 8px #0001;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            background:rgb(255, 255, 255);
            border: 2px solidrgb(212, 212, 212);
            padding: 0;
        }
        .card-calendario .card-body {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 16px 8px 8px 8px;
        }
        .card-calendario .d-flex {
            width: 100%;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .card-calendario .table-responsive {
            width: 100%;
        }
        .card-calendario table {
            background: #ffff;
            border-radius: 8px;
            margin: 0 auto;
            width: 98%;
            max-width: 98%;
            table-layout: fixed;
        }
        .card-calendario th,
        .card-calendario td {
            text-align: center;
            padding: 8px 0;
        }
        .card-calendario th {
            color:rgb(255, 255, 255);
            font-weight: bold;
            background: #e3eafc;
        }
        .card-calendario td {
            background: #fff;
            width: 1%;
        }

        /* Gráfico */
        .card-grafico {
            min-width: 559px;
            max-width: 380px;
            min-height: 290px;
            width: 340px;
            box-shadow: 0 2px 8px #0001;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            background:rgb(255, 255, 255);
            border: 2px solidrgb(223, 223, 223);
            padding: 0;
        }
        .card-grafico .card-body {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 16px 8px 8px 8px;
        }
        .card-grafico canvas {
            width: 98% !important;
            max-width: 98% !important;
            height: auto !important;
        }

        /* Lista de tarefas */
        .card-lista-tarefas {
            min-width: 520px;
            max-width: 200%;
            width: 100%;
            margin: 0 auto;
            box-shadow: 0 2px 8px #0001;
            border-radius: 12px;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border: 2px solidrgb(212, 212, 212);
        }
        .card-lista-tarefas .card-body {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 16px 8px 8px 8px;
        }

        /* Painel inferior: mantém alinhamento e espaçamento */
        .painel-inferior-container {
            width: 100%;
            margin: 0 auto 32px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
        }

        /* Linha do calendário e gráfico lado a lado, alinhados com as boxes coloridas */
        .painel-row-cg {
            display: flex;
            flex-wrap: nowrap;
            justify-content: center;
            gap: 24px;
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Lista de tarefas: alinhada e mesmo tamanho das boxes coloridas */
        .painel-row-lista {
            display: flex;
            justify-content: center;
            width: 100%;
            max-width: 1100px;
            margin: 24px auto 0 auto;
        }

        /* Responsividade */
        @media (max-width: 900px) {
            .painel-row-cg {
                flex-direction: column;
                gap: 18px;
                align-items: center;
            }
            .card-calendario,
            .card-grafico,
            .card-lista-tarefas {
                max-width: 98vw;
                min-width: 200px;
            }
            .card-lista-tarefas {
                max-width: 99vw;
            }
        }
        @media (max-width: 600px) {
            .card-calendario,
            .card-grafico,
            .card-lista-tarefas {
                max-width: 99vw;
                min-width: 120px;
            }
        }
    </style>

</body>
</html>