<?php
session_start();
include('../conexao.php');

// Busca os clientes e serviços para preencher o formulário
$clientes = $pdo->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
$servicos = $pdo->query("SELECT * FROM serviços")->fetchAll(PDO::FETCH_ASSOC);

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $servico_id = $_POST['servico_id'];
    $descricao = $_POST['descricao'];

    if (!empty($cliente_id) && !empty($servico_id) && !empty($descricao)) {
        $sql = "INSERT INTO chamados (cliente_id, servico_id, descricao) VALUES (:cliente_id, :servico_id, :descricao)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cliente_id' => $cliente_id, 'servico_id' => $servico_id, 'descricao' => $descricao]);
        echo "Chamado cadastrado com sucesso!";
        header("Location: listar_chamados.php");
        exit();
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
    <title>Cadastro de Chamado - Assistência Técnica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Cadastro de Chamado</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select class="form-select" id="cliente_id" name="cliente_id" required>
                <option value="">Selecione um cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="servico_id" class="form-label">Serviço</label>
            <select class="form-select" id="servico_id" name="servico_id" required>
                <option value="">Selecione um serviço</option>
                <?php foreach ($servicos as $servico): ?>
                    <option value="<?php echo $servico['id']; ?>"><?php echo $servico['nome']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição do Problema</label>
            <textarea class="form-control" id="descricao" name="descricao" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
</body>
</html>
