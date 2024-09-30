<?php
/* Devido ao fato de ser um sistema de cadastro de clientes, assumi que é responsabilidade de
outro sistema cadastrar os funcionários, sendo assim, preenchi a tabela de funcionários com 3
funcionários fictícios para poder testar o sistema.*/

require_once 'Database.php';

class Funcionario {
    private $conn;
    private $table_name = "funcionarios";
    private $ctrlSessao;

    public function __construct($database, $ctrlSessao) {
        $this->conn = $database;
        $this->ctrlSessao = $ctrlSessao;
    }

    public function login($login, $password) {
        $query = "SELECT id, nome, login, senha FROM " . $this->table_name . " WHERE login = ? LIMIT 0,1";

        // Utilizando prepared statement para evitar SQL Injection
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $login);
        $stmt->execute();

        // Verificando se o usuário foi encontrado
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificando se a senha está correta
            if (password_verify($password, $row['senha'])) {
                $this->ctrlSessao->login($row['id'], $row['nome']);
                return true;
            }
        }

        return false;
    }

    // Método que altera a senha do funcionário e a armazena no db como hash
    public function alterarSenha($idFuncionario, $senhaAtual, $novaSenha) {
        $query = "SELECT senha FROM " . $this->table_name . " WHERE id = :idFuncionario";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idFuncionario', $idFuncionario);
        $stmt->execute();

        // Verificações de usuário e senha
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $senhaHash = $row['senha'];

            if (password_verify($senhaAtual, $senhaHash)) {
                // Alterando a senha
                $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE " . $this->table_name . " SET senha = :novaSenha WHERE id = :idFuncionario";

                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->bindParam(':novaSenha', $novaSenhaHash);
                $updateStmt->bindParam(':idFuncionario', $idFuncionario);

                return $updateStmt->execute(); // Retorna o resultado da atualização
            } else {
                return false; // Senha atual não confere
            }
        } else {
            return false; // Funcionário não encontrado
        }
    }
}
?>
