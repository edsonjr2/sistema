<!-- atualizar_chamado.php -->
<?php
session_start();
include_once '../conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Busca o chamado
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $chamado = $pdo->query("SELECT * FROM chamados WHERE id = $id")->fetch();

    // Atualiza o chamado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $status = $_POST['status'];
        $sql = "UPDATE chamados SET status = :status WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['status' => $status, 'id' => $id]);
        echo "Chamado atualizado com sucesso!";
        header("Location: listar_chamados.php"); // Redireciona após atualização
        exit();
    }
} else {
    echo "Chamado não encontrado!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Chamado</title>
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
                <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1>Atualizar Chamado</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="aberto" <?= $chamado['status'] == 'aberto' ? 'selected' : '' ?>>Aberto</option>
                <option value="em andamento" <?= $chamado['status'] == 'em andamento' ? 'selected' : '' ?>>Em Andamento</option>
                <option value="concluído" <?= $chamado['status'] == 'concluído' ? 'selected' : '' ?>>Concluído</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Chamado</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
