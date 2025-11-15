<?php
require_once "conexao.php";
if (isset($pdo) && $pdo instanceof PDO) {
    echo "Conexão PDO OK";
} else {
    echo "Variável \$pdo não encontrada";
}
