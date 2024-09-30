<?php

require_once '../../src/CtrlSessao.php';
require_once '../../src/Cliente.php';

$ctrlSessao = new CtrlSessao();
$ctrlSessao->checkSession();
if (!$ctrlSessao->isLoggedIn()) {
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = new Cliente();

    // Pegando os dados do formulário
    $nome = trim($_POST['nome']);
    $cpf = preg_replace('/\D/', '', $_POST['cpf']);
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $telefone = preg_replace('/\D/', '', $_POST['telefone']);
    $email = trim($_POST['email']);
    $login = trim(str_replace(' ', '', $_POST['login']));
    $senha = $_POST['senha'];

    // Validações
    $erros = [];

    if (empty($nome)) {
        $erros[] = "O nome é obrigatório.";
    }
    if (empty($cpf) || strlen($cpf) !== 11) {
        $erros[] = "O CPF deve conter 11 dígitos.";
    }
    if (empty($data_nascimento)) {
        $erros[] = "A data de nascimento é obrigatória.";
    }
    if (empty($sexo)) {
        $erros[] = "O sexo é obrigatório.";
    }
    if (empty($telefone) || strlen($telefone) !== 11) {
        $erros[] = "O telefone deve conter 11 dígitos (incluindo DDD).";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Por favor, insira um email válido.";
    }
    if (empty($login)) {
        $erros[] = "O login não pode conter espaços em branco.";
    }
    if (empty($senha) || strlen($senha) < 8 || preg_match('/\s/', $senha)) {
        $erros[] = "A senha deve ter no mínimo 8 caracteres e não conter espaços.";
    }

    // Prepara o array de response para exibir no front
    $response = [];

    // Exibe erros de validação, se houver
    if (!empty($erros)) {
        $response['status'] = 'error';
        $response['message'] = implode("\n", $erros);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Chamando o método para cadastrar o cliente
    $resultado = $cliente->cadastrar($nome, $cpf, $data_nascimento, $sexo, $telefone, $email, $login, $senha);

    if (isset($resultado['error'])) {
        $response['status'] = 'error';
        $response['message'] = $resultado['error'];
    } else {
        $response['status'] = 'success';
        $response['message'] = "Cliente cadastrado com sucesso!";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>

<div class="centralizador">
    <div class="container-cadastro">
        <div class="cabecalho">
            <h2>Cadastrar Cliente</h2>
        </div>
        <div class="div-form">
            <form id="form-cadastro" method="POST" style="text-align: center;">
                <div class="linha-form">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="linha-form">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" maxlength="14" required>
                </div>

                <div class="linha-form">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required pattern="\d{4}-\d{2}-\d{2}">
                </div>

                <div class="linha-form">
                    <label for="sexo">Sexo:</label>
                    <select id="sexo" name="sexo" required>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>

                <div class="linha-form">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" maxlength="15" required>
                </div>

                <div class="linha-form">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="linha-form">
                    <label for="login">Login:</label>
                    <input type="text" id="login" name="login" required>
                </div>

                <div class="linha-form">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <button class="botao-salvar" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>


<script src="../js/cadastra-cliente.js"></script>