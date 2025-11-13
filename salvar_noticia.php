<?php
require_once "conexao.php"; // usa sua conexão existente

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST["titulo"];
    $conteudo = $_POST["conteudo"];

    $sql = "INSERT INTO noticias (titulo, conteudo) VALUES (:titulo, :conteudo)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":titulo", $titulo);
    $stmt->bindParam(":conteudo", $conteudo);

    if ($stmt->execute()) {
        echo "✅ Notícia salva com sucesso! <a href='adicionar_noticia.php'>Adicionar outra</a>";
    } else {
        echo "❌ Erro ao salvar notícia.";
    }
}
?>
