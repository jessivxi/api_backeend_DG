<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .divisor_painel_adm {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            height: 40px;
            background:rgb(255, 255, 255);
            width: calc(100vw - 250px); /* Não ultrapassa a sidebar */
            border-bottom: 1px solid #ccc;
            color: #222;
            position: fixed;
            top: 0;
            left: 250px; /* Começa após a sidebar */
            z-index: 1100;
            box-shadow: none;
            margin-bottom: 0;
        }
        .divisor_painel_adm .nav-icons {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-right: 24px;
        }
        .nav-icon-btn {
            background: none;
            border: none;
            color: #222;
            font-size: 1.3rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }
        .nav-icon-btn:hover {
            color: #facc15;
        }
        .admin-status {
            display: flex;
            align-items: center;
            font-size: 1rem;
            gap: 6px;
            font-weight: 500;
            background: none;
            padding: 0;
            border-radius: 0;
            color: #222;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: rgb(238, 238, 238);
            color: black;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            z-index: 1000;
            box-shadow: 2px 0 8px #0001;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: rgb(217, 217, 217);
            margin-bottom: 10px;
        }
        .menu {
            width: 100%;
            list-style: none;
            padding: 0;
        }
        .menu li {
            width: 100%;
            text-align: center;
            padding: 15px 0;
            cursor: pointer;
            transition: background-color 0.3s;
            border-bottom: 1px solid #ccc;
        }
        .menu li a {
            text-decoration: none;
            font-size: 13px;
            color: black;
            display: block;
        }
        .menu a1 {
            text-decoration: none;
            font-size: 15px;
            text-align: center;
            color: rgba(0, 0, 0, 0.51);
            display: block;
        }
        .menu li a:hover {
            color: #0096D1;
        }
        @media (max-width: 700px) {
            .sidebar { width: 100vw; left: 0; top: 0; }
            .divisor_painel_adm { left: 0; width: 100vw; }
        }
    </style>
</head>
<body>
    <!-- Linha superior fixa com ícones, agora só no conteúdo -->
    <div class="sidebar">
        <div class="profile-pic"></div>
        <ul class="menu">
            <a1 href="#">Administrador Odyssey</a1>
        </ul>
        <ul class="menu">
            <li><a href="index.php">Painel</a></li>
            <li><a href="GerenciadorUser.php">Gerenciamento de Usuário</a></li>
            <li><a href="Controlservice.php">Controle de Serviços</a></li>
            <li><a href="Controlvendas.php">Controle de Vendas</a></li>
            <li><a href="SuportTec.php">Suporte Técnico</a></li>
        </ul>
    </div>
    <div class="divisor_painel_adm">
        <div class="nav-icons">
            <form action="login.php" method="get" style="display:inline; margin:0; padding:0;">
                <button type="submit" class="nav-icon-btn" title="Voltar para login">
                    <i class="bi bi-box-arrow-left"></i>
                </button>
            </form>
            <span class="admin-status" title="Administrador logado">
                <i class="bi bi-person-circle"></i> ADM
            </span>
        </div>
    </div>
</body>
</html>