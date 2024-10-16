<?php
session_start();
include('../conexao.php'); // Ajuste o caminho conforme necessário

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $senha = $_POST['senha'];

    // Validação simples
    if (!empty($username) && !empty($senha)) {
        // Verifica se o usuário já existe
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $usuarioExistente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioExistente) {
            echo "Erro: O nome de usuário já está em uso.";
        } else {
            // Hash da senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // Insere o novo usuário no banco de dados
            $sql = "INSERT INTO usuarios (username, senha) VALUES (:username, :senha)";
            $stmt = $pdo->prepare($sql);

            try {
                $stmt->execute(['username' => $username, 'senha' => $senhaHash]);
                echo "Usuário cadastrado com sucesso!";
                header("Location: dashboard.php"); // Redireciona para o dashboard após o cadastro
                exit();
            } catch (PDOException $e) {
                echo "Erro ao cadastrar usuário: " . $e->getMessage();
            }
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
    <title>Cadastro de Usuário - Assistência Técnica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Cadastro de Usuário Administrador</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Usuário</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
</body>
</html>
