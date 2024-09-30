$(document).ready(function() {
    // A tela inicial sempre é carregada por padrão
    $("#content").load("tela_inicial.php");

    // As demais telas podem ser carregadas por eventos de clique
    $("#link-inicio").click(function(e) {
        e.preventDefault();
        $("#content").load("tela_inicial.php");
    });

    $("#link-senha").click(function(e) {
        e.preventDefault();
        $("#content").load("mudar_senha.php", function() {
            $.getScript("mudar-senha.js");
        });
    });

    $("#link-clientes").click(function(e) {
        e.preventDefault();
        $("#content").load("lista_clientes.php");
    });
});

/* Os scripts adicionam um evento de click quando se aperta em um
 botão do menu e o mantém "pressionado", para, junto com o css, deixá-lo
 colorido. Também colapsa o menu em smartphones.*/

// Seleciona todos os itens do menu
var menuItem = document.querySelectorAll('.item-menu');

function selectPage() {
    // Remove a classe 'ativo' de todos os itens
    menuItem.forEach((item) => item.classList.remove('ativo'));
    // Adiciona a classe 'ativo' ao item clicado
    this.classList.add('ativo');

    // Caso em uma tela pequena, colapsa o menu após clicar em uma página
    if (window.innerWidth < 768) {
        toggleMenu();
    }
}

// Adiciona o evento de clique para cada item do menu
menuItem.forEach((item) => item.addEventListener('click', selectPage));

// Função para alternar o menu lateral
function toggleMenu() {
    var menuLateral = document.getElementById('menu-lateral');
    menuLateral.classList.toggle('menu-lateral-aberto');
}

// Adiciona o evento de clique para o botão hamburguer
document.getElementById('hamburger-menu').addEventListener('click', toggleMenu);