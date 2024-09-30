$(document).ready(function () {
    // Máscara para CPF
    $('#cpf').mask('000.000.000-00', { reverse: true });

    // Máscara para telefone
    $('#telefone').mask('(00) 00000-0000');

    // Envio do formulário
    $('#form-edita-cliente').on('submit', function (event) {
        event.preventDefault();

        // Pegando os valores dos campos
        var nome = $('#nome').val().trim();
        // Formatação do nome: primeira letra de cada parte em maiúscula
        nome = nome.split(' ').map(function (parte) {
            return parte.charAt(0).toUpperCase() + parte.slice(1).toLowerCase();
        }).join(' ');
        $('#nome').val(nome);
        var cpf = $('#cpf').val().replace(/\D/g, '');
        var data_nascimento = $('#data_nascimento').val().trim();
        var sexo = $('#sexo').val().trim();
        var telefone = $('#telefone').val().replace(/\D/g, '');
        var email = $('#email').val().trim();

        // Validações
        var erros = [];

        if (nome === "") {
            erros.push("O nome é obrigatório.");
        }
        if (cpf.length !== 11) {
            erros.push("O CPF inválido ou incompleto.");
        }
        if (data_nascimento === "") {
            erros.push("A data de nascimento é obrigatória.");
        }
        if (sexo === "") {
            erros.push("O sexo é obrigatório.");
        }
        if (telefone.length !== 11) {
            erros.push("Telefone incompleto, verifique se incluiu o DDD.");
        }
        if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(email)) {
            erros.push("Por favor, insira um email válido.");
        }

        // Exibe erros, se houver
        if (erros.length > 0) {
            alert("Ocorreram os seguintes erros:\n" + erros.join("\n"));
            return;
        }

        // Serializando os dados e adicionando o CPF e telefone formatados
        let formData = $(this).serialize() + '&cpf=' + cpf + '&telefone=' + telefone;

        // Fazendo a requisição via AJAX
        $.ajax({
            url: 'edita_cliente.php',
            type: 'POST',
            async: true,
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert('Cliente editado com sucesso!');
                    $("#content").load("lista_clientes.php");
                } else {
                    alert("Ocorreram os seguintes erros:\n" + response.message);
                }
            },
            error: function () {
                alert('Erro ao editar o cliente.');
            }
        });
    });
});
