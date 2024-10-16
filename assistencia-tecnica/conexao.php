<?php
// Configurações do banco de dados
$host = 'localhost';  // Geralmente 'localhost'
$dbname = 'assistencia_tecnica';
$user = 'root';  // Usuário do MySQL
$pass = '';  // Senha do MySQL (deixe em branco se não houver)

// Criar conexão
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Configura PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>
