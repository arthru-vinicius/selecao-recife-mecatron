# Sistema de Gestão - Seleção Recife Mecatron

Este repositório contém um sistema de gestão desenvolvido como parte do processo seletivo da empresa Recife Mecatron. O sistema é projetado para gerenciar clientes, permitindo cadastro, edição, exclusão e autenticação de funcionários.
Usuário padrão para login: Username: adm / Senha: 1234

## Tecnologias Utilizadas

- **PHP**: Linguagem de programação utilizada no backend.
- **JavaScript**: Utilizado para interatividade no frontend.
- **HTML/CSS**: Para estrutura e estilo das páginas.
- **MariaDB**: Sistema de gerenciamento de banco de dados.

## Como Instalar

1. **Clone este repositório**:
   ```bash
   git clone https://github.com/arthru-vinicius/selecao-recife-mecatron.git
   ```

2. **Importe o banco de dados**:
   - Utilize o arquivo `sis_cadastros_db.sql` na pasta `database` para criar o banco de dados no seu ambiente local.
   - Execute o script no seu cliente MariaDB (por exemplo, phpMyAdmin ou MySQL Workbench).

3. **Configurações do Banco de Dados**:
   - Certifique-se de que as credenciais de conexão com o banco de dados estão corretas no arquivo `Database.php`.

4. **Inicie um servidor local**:
   - Use um servidor web como Apache ou Nginx. Se estiver usando o XAMPP ou MAMP, coloque o projeto na pasta `htdocs` ou `www`.

## Como Usar

1. **Acesse o sistema** através do navegador, indo para `http://localhost/selecao-recife-mecatron/public/pages/index.php`.
2. **Realize o login** utilizando as credenciais de um funcionário já cadastrado: Username: adm / Senha: 1234
4. Navegue pelas diferentes páginas para gerenciar clientes.

## Estrutura de Diretórios

```
SelecaoRecifeMecatron/
│
├── database/
│   └── sis_cadastros_db.sql           # Script SQL para criação do banco de dados
│
├── public/
│   ├── auth/
│   │   └── login.php                   # Página de login
│   │
│   ├── css/
│   │   └── style.css                   # Estilos CSS do projeto
│   │
│   ├── js/
│   │   ├── cadastra-cliente.js         # Scripts para a página de cadastro de clientes
│   │   ├── dashboard.js                 # Scripts para a página do dashboard
│   │   ├── edita-cliente.js             # Scripts para a página de edição de cliente
│   │   ├── lista-clientes.js           # Scripts para a página de lista de clientes
│   │   ├── mudar-senha.js              # Scripts para a página de mudança de senha
│   │   └── tela-inicial.js             # Scripts para a página inicial
│   │
│   └── pages/
│       ├── cadastra_cliente.php         # Página para cadastro de novos clientes
│       ├── dashboard.php                # Página do dashboard
│       ├── edita_cliente.php            # Página para edição de dados de clientes
│       ├── lista_clientes.php           # Página que lista todos os clientes cadastrados
│       ├── mudar_senha.php              # Página para mudança de senha do funcionário
│       ├── tela_inicial.php             # Página inicial com informações gerais
│       └── index.php                    # Página de entrada do sistema
│
└── src/
    ├── Cliente.php                      # Classe para gerenciar clientes
    ├── CtrlSessao.php                   # Classe para controle de sessão
    ├── Database.php                     # Classe para conexão e manipulação do banco de dados
    ├── Funcionario.php                  # Classe para gerenciar funcionários
    └── processa_exclusao.php           # Script para processamento de exclusão de clientes
```


## Licença

Este projeto é de uso exclusivo para fins acadêmicos e não deve ser utilizado comercialmente.
