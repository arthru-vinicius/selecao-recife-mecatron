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
$clientes = $cliente->listar();

function formatarCpf($cpf)
{
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
}

function formatarTelefone($telefone)
{
    if (strlen($telefone) == 11) {
        return preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $telefone);
    } elseif (strlen($telefone) == 10) {
        return preg_replace("/(\d{2})(\d{4})(\d{4})/", "($1) $2-$3", $telefone);
    }
    return $telefone;
}
?>

<div class="centralizador-lista">
    <div class="container-lista">
        <div class="cabecalho-lista">
            <div class="titulo">
                <h2>Listagem de Clientes</h2>
            </div>

            <div class="botoes">
                <button id="btnCadastrar">Cadastrar</button>
            </div>
        </div>

        <div class="tabela-clientes">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                        <th>Sexo</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($clientes) > 0): ?>
                        <?php foreach ($clientes as $c): ?>
                            <tr>
                                <td><?php echo $c['id']; ?></td>
                                <td><?php echo $c['nome']; ?></td>
                                <td><?php echo formatarCpf($c['cpf']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($c['data_nascimento'])); ?></td>
                                <td><?php echo $c['sexo']; ?></td>
                                <td><?php echo formatarTelefone($c['telefone']); ?></td>
                                <td><?php echo $c['email']; ?></td>
                                <td>
                                    <button class="btnEditar" data-id="<?php echo $c['id']; ?>">Editar</button>
                                    <button class="btnExcluir" data-id="<?php echo $c['id']; ?>">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">Nenhum cliente encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../js/lista-clientes.js"></script>