<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}

// Inclui a conexão com o banco de dados
include_once '../conexao.php';

// Consultar total de clientes
$stmt = $pdo->query("SELECT COUNT(*) AS total_clientes FROM clientes");
$total_clientes = $stmt->fetchColumn();

// Consultar total de serviços
$stmt = $pdo->query("SELECT COUNT(*) AS total_servicos FROM serviços");
$total_servicos = $stmt->fetchColumn();

// Consultar total de chamados
$stmt = $pdo->query("SELECT COUNT(*) AS total_chamados FROM chamados");
$total_chamados = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Assistência Técnica</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="clientes.php">Gerenciar Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar_clientes.php">Listar Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastrar_servico.php">Cadastrar Serviço</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar_servicos.php">Listar Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastrar_chamado.php">Cadastrar Chamado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar_chamados.php">Listar Chamados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastrar_estoque.php">Cadastrar Estoque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar_estoque.php">Listar Estoque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1>Bem-vindo ao Dashboard da Assistência Técnica</h1>
    <p>Use o menu acima para gerenciar clientes, serviços e estoques.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total de Clientes</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_clientes; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total de Serviços</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_servicos; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total de Chamados</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_chamados; ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
