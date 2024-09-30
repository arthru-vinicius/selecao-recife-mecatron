<?php

require_once '../../src/CtrlSessao.php';

$ctrlSessao = new CtrlSessao();
$ctrlSessao->checkSession();
if (!$ctrlSessao->isLoggedIn()) {
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}

// Chamando o logout
if (isset($_GET['logout'])) {
    $ctrlSessao->logout();
}

$userData = $ctrlSessao->getUserData();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="hamburger-menu" id="hamburger-menu">
        <i class="bi bi-list"></i>
    </div>

    <nav class="menu-lateral" id="menu-lateral">
        <ul class="lista-menu">
            <li class="item-menu ativo">
                <a href="#" id="link-inicio">
                    <span class="icon"><i class="bi bi-columns-gap"> Tela Inicial</i></span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#" id="link-clientes">
                    <span class="icon"><i class="bi bi-bag-heart"> Lista de Clientes</i></span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#" id="link-senha">
                    <span class="icon"><i class="bi bi-shield-lock"> Alterar Senha</i></span>
                </a>
            </li>
            <li class="item-menu">
                <a href="?logout=true">
                    <span class="icon"><i class="bi bi-box-arrow-left"> Sair</i></span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="conteudo-principal">
        <div class="titulo-principal">
            <h1>Olá, <?php echo $_SESSION['nome']; ?>!</h1>
        </div>
        <div class="content" id="content">
            <!-- Nessa área será carregado o conteúdo pelo AJAX -->
        </div>
        <footer>
            <p>Desenvolvido por Arthur Vinicius Rodrigues, para o desafio da Recife Mecatron</p>
        </footer>
    </div>
    <script src="../js/dashboard.js"></script>
</body>

</html>