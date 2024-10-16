<?php
include('../conexao.php'); // Inclui a conexão com o banco de dados

// Verifica se o ID do cliente foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara e executa a exclusão do cliente
    $sql = "DELETE FROM clientes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    echo "Cliente excluído com sucesso!";
    echo "<br><a href='listar_clientes.php'>Voltar para a lista de clientes</a>";
} else {
    echo "ID do cliente não fornecido.";
}
?>
