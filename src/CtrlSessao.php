<?php

define('BASE_URL', 'http://localhost/SelecaoRecifeMecatron/public');
define('SESSION_TIMEOUT', 3600);

class CtrlSessao {
    public function __construct() {
        // Verificando se já existe uma sessão antes de tentar criar uma
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Armazena o ID e nome do usuário
    public function login($idFuncionario, $nome) {
        $_SESSION['usuario_id'] = $idFuncionario;
        $_SESSION['nome'] = $nome;
    }

    // Verificando se o usuário está logado
    public function isLoggedIn() {
        return isset($_SESSION['usuario_id']);
    }

    // Desloga o usuário após 1 hora de login, para melhorar a segurança
    public function checkSession() {
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
            $this->logout();
        }
        $_SESSION['last_activity'] = time();
    }

    // Encerra a sessão e direciona para a página de login
    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL . "/auth/login.php");
        exit();
    }

    // Retorna os dados do usuário
    public function getUserData() {
        return [
            'id' => $_SESSION['usuario_id'] ?? null,
            'nome' => $_SESSION['nome'] ?? null,
        ];
    }
}
?>
