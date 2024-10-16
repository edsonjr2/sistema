<?php
include('../conexao.php'); // Inclui a conexão com o banco de dados

// Consulta para obter todos os serviços
$sql = "SELECT * FROM servicos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Serviços</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Listar Serviços</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Serviço</th>
                <th>Descrição</th>
                <th>Preço (R$)</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicos as $servico): ?>
            <tr>
                <td><?php echo $servico['id']; ?></td>
                <td><?php echo $servico['nome']; ?></td>
                <td><?php echo $servico['descricao']; ?></td>
                <td><?php echo number_format($servico['preco'], 2, ',', '.'); ?></td>
                <td><?php echo date('d/m/Y H:i', strtotime($servico['data_cadastro'])); ?></td>
                <td>
                    <a href="editar_servico.php?id=<?php echo $servico['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="cadastrar_servico.php" class="btn btn-primary">Cadastrar Novo Serviço</a>
</div>
</body>
</html>
