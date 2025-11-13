<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Notícia</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 0; padding: 40px; }
    form { background: white; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    input, textarea, button { width: 100%; padding: 10px; margin: 10px 0; }
    button { background: #007bff; color: white; border: none; cursor: pointer; }
    button:hover { background: #0056b3; }
  </style>
</head>
<body>
  <h2>📰 Adicionar Nova Notícia</h2>
  <form action="salvar_noticia.php" method="POST">
    <label>Título:</label>
    <input type="text" name="titulo" required>

    <label>Conteúdo:</label>
    <textarea name="conteudo" rows="5" required></textarea>

    <button type="submit">💾 Salvar Notícia</button>
  </form>
</body>
</html>
