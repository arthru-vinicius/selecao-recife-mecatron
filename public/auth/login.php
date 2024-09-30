<?php
require_once '../../src/Database.php';
require_once '../../src/Funcionario.php';
require_once '../../src/CtrlSessao.php';

$database = new Database();
$db = $database->getConnection();
$ctrlSessao = new CtrlSessao();
$funcionario = new Funcionario($db, $ctrlSessao);

// Lógica de login e redirecionamento para o Dashboard
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($funcionario->login($login, $password)) {
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        $error = "Login ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="login-body">
    <div class="cabecalho-login">
        <h2 class="h2-login">Login</h2>
    </div>
    <div class="form-login">
        <form method="post" action="">
            <div>
                <label class="label-login" for="login">Nome de Usuário</label>
                <input class="input-login" type="text" name="login" placeholder="Login" required>
            </div>
            <div>
                <label class="label-login" for="password">Senha</label>
                <input class="input-login" type="password" name="password" placeholder="Senha" required>
            </div>
            <button class="button-login" type="submit">Entrar</button>
            <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
        </form>
    </div>
</body>

</html>