<?php

require_once '../../src/CtrlSessao.php';
require_once '../../src/Funcionario.php';
require_once '../../src/Database.php';

$ctrlSessao = new CtrlSessao();
$ctrlSessao->checkSession();
if (!$ctrlSessao->isLoggedIn()) {
    header("Location: ../auth/login.php");
    exit();
}

// Processa a mudança da senha
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $senhaAtual = $_POST['senha_atual'];
    $novaSenha = $_POST['nova_senha'];
    $repetirSenha = $_POST['repetir_senha'];

    // Valida se as senhas são iguais e implementa as regras da senha
    if ($novaSenha !== $repetirSenha) {
        echo "As senhas não coincidem.";
        exit();
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $novaSenha)) {
        echo "A nova senha deve conter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas e números.";
        exit();
    } else {
        $db = new Database();
        $funcionario = new Funcionario($db->getConnection(), $ctrlSessao);
        $userData = $ctrlSessao->getUserData();
        $idFuncionario = $userData['id'];

        // Tenta alterar a senha
        if ($funcionario->alterarSenha($idFuncionario, $senhaAtual, $novaSenha)) {
            echo "Senha alterada com sucesso!";
            exit();
        } else {
            echo "Falha ao alterar a senha. Verifique sua senha atual.";
            exit();
        }
    }
}
?>

<div class="centralizador">
    <div class="container-senha">
        <div class="cabecalho">
            <h2>Alterar Senha</h2>
        </div>
        <div class="div-form">
            <form class="form-senha" id="form-mudar-senha" method="POST">
                <div class="linha-form">
                    <label for="senha_atual">Senha Atual</label>
                    <input type="password" id="senha_atual" name="senha_atual" required>
                </div>
                <div class="linha-form">
                    <label for="nova_senha">Nova Senha</label>
                    <input type="password" id="nova_senha" name="nova_senha" required>
                </div>
                <div class="linha-form">
                    <label for="repetir_senha">Repita a Nova Senha</label>
                    <input type="password" id="repetir_senha" name="repetir_senha" required>
                </div>
                <button class="botao-salvar" type="submit">Salvar</button>
            </form>
            <div id="resultado"></div>
        </div>
    </div>
</div>

<script src="../js/mudar-senha.js"></script>