<!-- listar_estoque.php -->
<?php
session_start();
include_once '../conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtém os itens do estoque
$itens = $pdo->query("SELECT * FROM estoque")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Estoque</title>
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
    <h1>Lista de Itens no Estoque</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itens as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['nome'] ?></td>
                    <td><?= $item['quantidade'] ?></td>
                    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                    <td><?= $item['data_cadastro'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
