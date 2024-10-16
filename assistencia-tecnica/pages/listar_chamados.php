<?php
session_start();
include('../conexao.php');

// Busca os chamados registrados
$sql = "SELECT c.id, cl.nome AS cliente_nome, s.nome AS servico_nome, c.descricao, c.status, c.data_cadastro
        FROM chamados c
        JOIN clientes cl ON c.cliente_id = cl.id
        JOIN serviços s ON c.servico_id = s.id";
$stmt = $pdo->query($sql);
$chamados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Chamados - Assistência Técnica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Chamados Registrados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chamados as $chamado): ?>
                <tr>
                    <td><?php echo $chamado['id']; ?></td>
                    <td><?php echo $chamado['cliente_nome']; ?></td>
                    <td><?php echo $chamado['servico_nome']; ?></td>
                    <td><?php echo $chamado['descricao']; ?></td>
                    <td><?php echo ucfirst($chamado['status']); ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($chamado['data_cadastro'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="cadastrar_chamado.php" class="btn btn-primary">Registrar Novo Chamado</a>
</div>
</body>
</html>
