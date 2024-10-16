<?php
include('../conexao.php'); // Inclui a conexão com o banco de dados

// Verifica se o ID do serviço foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do serviço a ser editado
    $sql = "SELECT * FROM servicos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $servico = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o serviço existe
    if (!$servico) {
        die("Serviço não encontrado.");
    }
}

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    // Atualiza os dados do serviço no banco de dados
    $sql = "UPDATE servicos SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nome' => $nome,
        'descricao' => $descricao,
        'preco' => $preco,
        'id' => $id
    ]);
    echo "Serviço atualizado com sucesso!";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Serviço</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Serviço</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $servico['nome']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao"><?php echo $servico['descricao']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço (R$)</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo $servico['preco']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Serviço</button>
    </form>
</div>
</body>
</html>
