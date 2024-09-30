$(document).ready(function() {
    $('#form-mudar-senha').on('submit', function(e) {
        e.preventDefault();

        var senhaAtual = $('#senha_atual').val();
        var novaSenha = $('#nova_senha').val();
        var repetirSenha = $('#repetir_senha').val();

        // Verifica se as senhas coincidem
        if (novaSenha !== repetirSenha) {
            alert('As senhas não coincidem.');
        } 
        // Verifica se contém espaços em branco
        else if (/\s/.test(novaSenha)) {
            alert('A senha não deve conter espaços em branco.');
        } 
        // Verifica o padrão de senha
        else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/.test(novaSenha)) {
            alert('A nova senha deve ter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas e números.');
        } 
        // Se passar nas validações, envia via AJAX
        else {
            $.ajax({
                type: 'POST',
                url: 'mudar_senha.php',
                async: true,
                data: {
                    senha_atual: senhaAtual,
                    nova_senha: novaSenha,
                    repetir_senha: repetirSenha
                },
                success: function(response) {
                    // Exibe mensagem de sucesso ou erro e, caso sucesso, limpa o formulário
                    if (response.includes('Senha alterada com sucesso!')) {
                        $('#form-mudar-senha')[0].reset();
                        $('#resultado').html('<div class="alert alert-success">' + response + '</div>');
                    } else {
                        $('#resultado').html('<div class="alert alert-danger">' + response + '</div>');
                    }
                },
                error: function() {
                    alert('Erro ao tentar alterar a senha.');
                }
            });
        }
    });
});
