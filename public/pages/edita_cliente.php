<?php

require_once '../../src/CtrlSessao.php';
require_once '../../src/Cliente.php';

$ctrlSessao = new CtrlSessao();
$ctrlSessao->checkSession();
if (!$ctrlSessao->isLoggedIn()) {
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}

$cliente = new Cliente();
$dados_cliente = null;

// Verifica se o ID do cliente foi passado pela URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Busca os dados do cliente para edição usando o método buscarPorId
    $dados_cliente = $cliente->buscarPorId($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $cpf = preg_replace('/\D/', '', $_POST['cpf']);
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $telefone = preg_replace('/\D/', '', $_POST['telefone']);
    $email = trim($_POST['email']);

    $resultado = $cliente->editar($id, $nome, $cpf, $data_nascimento, $sexo, $telefone, $email);

    // Resposta com JSON
    $response = [];
    if (isset($resultado['error'])) {
        $response['status'] = 'error';
        $response['message'] = $resultado['error'];
    } else {
        $response['status'] = 'success';
        $response['message'] = "Cliente editado com sucesso!";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>

<div class="centralizador">
    <div class="container-cadastro">
        <div class="cabecalho">
            <h2>Editar Cliente</h2>
        </div>
        <div class="div-form">
            <form id="form-edita-cliente" method="POST" style="text-align: center;">
                <input type="hidden" name="id" value="<?php echo $dados_cliente['id']; ?>">
                <div class="linha-form">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo $dados_cliente['nome']; ?>" required>
                </div>

                <div class="linha-form">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="<?php echo $dados_cliente['cpf']; ?>" maxlength="14" required>
                </div>

                <div class="linha-form">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $dados_cliente['data_nascimento']; ?>" required pattern="\d{4}-\d{2}-\d{2}">
                </div>

                <div class="linha-form">
                    <label for="sexo">Sexo:</label>
                    <select id="sexo" name="sexo" required>
                        <option value="M" <?php echo $dados_cliente['sexo'] == 'M' ? 'selected' : ''; ?>>Masculino</option>
                        <option value="F" <?php echo $dados_cliente['sexo'] == 'F' ? 'selected' : ''; ?>>Feminino</option>
                    </select>
                </div>

                <div class="linha-form">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" value="<?php echo $dados_cliente['telefone']; ?>" maxlength="15" required>
                </div>

                <div class="linha-form">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $dados_cliente['email']; ?>" required>
                </div>

                <button class="botao-salvar" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>

<script src="../js/edita-cliente.js"></script>
