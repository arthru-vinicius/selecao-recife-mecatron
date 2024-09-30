$(document).ready(function() {
    // Ação para cadastrar cliente
    $("#btnCadastrar").click(function(e) {
        e.preventDefault();
        $("#content").load("cadastra_cliente.php");
    });

    // Ação para editar cliente
    $(".btnEditar").click(function() {
        var id = $(this).data('id');
        $("#content").load("edita_cliente.php?id=" + id);
    });

    // Ação para excluir cliente
    $(".btnExcluir").click(function() {
        var id = $(this).data('id');
        if (confirm("Você tem certeza que deseja excluir este cliente?")) {
            $.ajax({
                url: '../../src/processa_exclusao.php',
                method: 'POST',
                data: { id: id },
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        // Atualiza a lista de clientes sem recarregar a página
                        $("#content").load("lista_clientes.php");
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Erro ao excluir cliente. Tente novamente.');
                }
            });
        }
    });
});
