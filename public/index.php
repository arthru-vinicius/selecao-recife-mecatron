<?php

require_once '../src/CtrlSessao.php';

session_start();

$ctrlSessao = new CtrlSessao();
$ctrlSessao->checkSession();

// Verificando se o usuário já está logado e o direcionando para login ou dashboard
if ($ctrlSessao->isLoggedIn()) {
    header("Location: " . BASE_URL . "/pages/dashboard.php");
    exit();
} else {
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}
?>
