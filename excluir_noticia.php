<?php
// Incluir conexão
require_once 'conexao.php';

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        
        // Verificar se a notícia existe
        $stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
        $stmt->execute([$id]);
        $noticia = $stmt->fetch();
        
        if (!$noticia) {
            die("Notícia não encontrada!");
        }
        
        // Excluir a notícia
        $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
        $stmt->execute([$id]);
        
        // Redirecionar de volta para noticias.php com mensagem de sucesso
        header("Location: noticias.php?sucesso=Notícia excluída com sucesso!");
        exit();
        
    } catch (PDOException $e) {
        die("Erro ao excluir notícia: " . $e->getMessage());
    }
} else {
    die("ID da notícia não especificado!");
}
?>