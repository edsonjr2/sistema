<!-- cadastrar_estoque.php -->
<?php
session_start();
include_once '../conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    // Validação simples
    if (!empty($nome) && !empty($quantidade) && !empty($preco)) {
        // Insere o item no estoque
        $sql = "INSERT INTO estoque (nome, quantidade, preco) VALUES (:nome, :quantidade, :preco)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nome' => $nome, 'quantidade' => $quantidade, 'preco' => $preco]);
        echo "Item cadastrado no estoque com sucesso!";
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
    <title>Cadastrar Item no Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Assistência Técnica</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="clientes.php">Gerenciar Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="listar_clientes.php">Listar Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="cadastrar_servico.php">Cadastrar Serviço</a></li>
                <li class="nav-item"><a class="nav-link" href="listar_servicos.php">Listar Serviços</a></li>
                <li class="nav-item"><a class="nav-link" href="cadastrar_chamado.php">Cadastrar Chamado</a></li>
                <li class="nav-item"><a class="nav-link" href="listar_chamados.php">Listar Chamados</a></li>
                <li class="nav-item"><a class="nav-link" href="cadastrar_estoque.php">Cadastrar Estoque</a></li>
                <li class="nav-item"><a class="nav-link" href="listar_estoque.php">Listar Estoque</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1>Cadastrar Item no Estoque</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Item</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Item</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
