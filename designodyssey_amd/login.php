<!-- filepath: c:\xampp\htdocs\tnet\designodyssey_amd\Login_adm\login.php -->
<?php
// Inicia a sessão
session_start();
require_once('../../api-designOdyssey/conn.php'); // ajuste o caminho se necessário

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Busca o admin no banco
    $sql = "SELECT * FROM admins WHERE usuario = :usuario LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $username, PDO::PARAM_STR);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se encontrou e se a senha confere
    if ($admin && $password === $admin['senha']) { // Use password_verify se usar hash
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_nome'] = $admin['usuario'];
        header('Location: ../painel/index.php');
        exit;
    } else {
        $error = 'Usuário ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login - Administrador</title>
</head>
<body>
    <div class="login-container">
        <h1>Login - Administrador</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>
</html>