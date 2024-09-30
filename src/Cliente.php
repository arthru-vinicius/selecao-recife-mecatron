<?php

require_once 'Database.php';


class Cliente {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    // Cadastra um novo cliente
    public function cadastrar($nome, $cpf, $data_nascimento, $sexo, $telefone, $email, $login, $senha) {
        // Verifica se qualquer campo único já existe
        if ($this->cpfExiste($cpf)) {
            return ['error' => 'O CPF já está cadastrado.'];
        }
        if ($this->telefoneExiste($telefone)) {
            return ['error' => 'O telefone já está cadastrado.'];
        }
        if ($this->emailExiste($email)) {
            return ['error' => 'O email já está cadastrado.'];
        }
        if ($this->loginExiste($login)) {
            return ['error' => 'O login já está cadastrado.'];
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO clientes (nome, cpf, data_nascimento, sexo, telefone, email, login, senha) 
                VALUES (:nome, :cpf, :data_nascimento, :sexo, :telefone, :email, :login, :senha)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha_hash);

        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['error' => 'Erro ao cadastrar cliente.'];
        }
    }

    // Lista todos os clientes
    public function listar() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Edita os dados do cliente
    /* Assumi que não faz parte do escopo do projeto um funcionário poder alterar a senha do cliente
    e que isso deve ser responsabilidade da página que o cliente tem acesso*/
    public function editar($id, $nome, $cpf, $data_nascimento, $sexo, $telefone, $email) {
        // Verifica se qualquer campo único já existe e não pertence ao cliente atual
        if ($this->cpfExiste($cpf) && $this->buscarPorId($id)['cpf'] !== $cpf) {
            return ['error' => 'O CPF já está cadastrado.'];
        }
        if ($this->telefoneExiste($telefone) && $this->buscarPorId($id)['telefone'] !== $telefone) {
            return ['error' => 'O telefone já está cadastrado.'];
        }
        if ($this->emailExiste($email) && $this->buscarPorId($id)['email'] !== $email) {
            return ['error' => 'O email já está cadastrado.'];
        }
    
        $sql = "UPDATE clientes SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento, sexo = :sexo, telefone = :telefone, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
    
        if ($stmt->execute()) {
            return ['success' => true];
        } else {
            return ['error' => 'Erro ao editar cliente.'];
        }
    }

    // Busca um cliente pelo seu id
    public function buscarPorId($id) {
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Exclui um cliente
    public function excluir($id) {
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Conta a quantidade de clientes do db
    public function contar() {
        try {
            $query = "SELECT COUNT(*) as total FROM clientes";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            return 0;
        }
    }

    // Verifica se o CPF já existe no banco
    public function cpfExiste($cpf) {
        $sql = "SELECT id FROM clientes WHERE cpf = :cpf";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Verifica se o telefone já existe no banco
    public function telefoneExiste($telefone) {
        $sql = "SELECT id FROM clientes WHERE telefone = :telefone";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Verifica se o email já existe no banco
    public function emailExiste($email) {
        $sql = "SELECT id FROM clientes WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Verifica se o login já existe no banco
    public function loginExiste($login) {
        $sql = "SELECT id FROM clientes WHERE login = :login";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
}
?>