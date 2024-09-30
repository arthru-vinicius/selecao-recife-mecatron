<?php
require_once '../../src/CtrlSessao.php';
require_once '../../src/Cliente.php';

$ctrlSessao = new CtrlSessao();
$ctrlSessao->checkSession();
if (!$ctrlSessao->isLoggedIn()) {
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}

// Exibir data e hora
date_default_timezone_set('America/Sao_Paulo');
$dataAtual = date('d/m/Y');
$horaAtual = date('H:i:s');

$cliente = new Cliente();
$totalClientes = $cliente->contar();

// Gerando números aleatórios para fins ilustrativos
$clientesAtivos = rand(50, 100);
$atendimentosRealizados = rand(200, 500);
$totalVendas = rand(50000, 100000);
$produtosVendidos = rand(1000, 5000);
$dividas = rand(5, 20);
$metasAtingidas = rand(1, 10);
?>

<div class="tela-inicial">
    <div class="info-geral">
        <h1>Bem-vindo ao Sistema de Gestão</h1>
        <p>Data: <?php echo $dataAtual; ?></p>
        <p>Hora: <span id="hora-atual"><?php echo $horaAtual; ?></span></p>
        <p>Total de clientes cadastrados: <?php echo $totalClientes; ?></p>
        <p>Estatísticas fictícias</p>
        <h1>Estatísticas:</h1>
    </div>

    <div class="centralizador-estatisticas">
        <div class="container-estatisticas">
            <div class="linha-estatisticas">
                <div class="estatistica-item">
                    <h3>Clientes Ativos</h3>
                    <p><?php echo $clientesAtivos; ?></p>
                </div>
                <div class="estatistica-item">
                    <h3>Atendimentos Realizados</h3>
                    <p><?php echo $atendimentosRealizados; ?></p>
                </div>
                <div class="estatistica-item">
                    <h3>Total de Vendas</h3>
                    <p>R$ <?php echo number_format($totalVendas, 2, ',', '.'); ?></p>
                </div>
            </div>
            <div class="linha-estatisticas">
                <div class="estatistica-item">
                    <h3>Produtos Vendidos</h3>
                    <p><?php echo $produtosVendidos; ?></p>
                </div>
                <div class="estatistica-item">
                    <h3>Dívidas</h3>
                    <p><?php echo $dividas; ?></p>
                </div>
                <div class="estatistica-item">
                    <h3>Metas Atingidas</h3>
                    <p><?php echo $metasAtingidas; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/tela-inicial.js"></script>