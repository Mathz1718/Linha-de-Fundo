<?php
$host = 'localhost';
$dbname = 'linha_fundo';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Conectado
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>