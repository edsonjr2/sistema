<?php
include('../conexao.php'); // Inclui a conexão com o banco de dados

// Verifica se o ID do cliente foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do cliente a ser editado
    $sql = "SELECT * FROM clientes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o cliente existe
    if (!$cliente) {
        die("Cliente não encontrado.");
    }
}

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    // Atualiza os dados do cliente no banco de dados
    $sql = "UPDATE clientes SET nome = :nome, telefone = :telefone, email = :email, endereco = :endereco WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nome' => $nome,
        'telefone' => $telefone,
        'email' => $email,
        'endereco' => $endereco,
        'id' => $id
    ]);
    echo "Cliente atualizado com sucesso!";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Cliente</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $cliente['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $cliente['endereco']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
    </form>
</div>
</body>
</html>
