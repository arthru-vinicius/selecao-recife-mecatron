<?php
require_once 'Cliente.php';

$response = [];

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $cliente = new Cliente();

    if ($cliente->excluir($id)) {
        $response['status'] = 'success';
        $response['message'] = 'Cliente excluído com sucesso!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Erro ao excluir cliente.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'ID não fornecido.';
}

// Retorna a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
