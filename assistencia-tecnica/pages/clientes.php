<?php
include('../conexao.php'); // Inclui a conexão com o banco de dados

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    // Validação simples para garantir que o nome e telefone estão preenchidos
    if (!empty($nome) && !empty($telefone)) {
        try {
            // Insere o cliente no banco de dados
            $sql = "INSERT INTO clientes (nome, telefone, email, endereco, data_cadastro) 
                    VALUES (:nome, :telefone, :email, :endereco, NOW())";  // NOW() insere a data e hora atuais automaticamente
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nome' => $nome, 
                'telefone' => $telefone, 
                'email' => $email, 
                'endereco' => $endereco
            ]);

            echo "Cliente cadastrado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao cadastrar cliente: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Cadastro de Clientes</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <textarea class="form-control" id="endereco" name="endereco"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
    </form>
</div>
</body>
</html>
