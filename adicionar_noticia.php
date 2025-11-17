<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Adicionar Notícia - Linha de Fundo</title>
    <style>
        .form-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #111;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 255, 95, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #00ff5f;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            background-color: #1a1a1a;
            border: 1px solid #333;
            border-radius: 6px;
            color: #fff;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #00ff5f;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group input {
            width: auto;
        }

        .btn-submit {
            background-color: #00ff5f;
            color: #000;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #00cc4c;
            transform: translateY(-2px);
        }

        .success-message {
            background-color: #00ff5f;
            color: #000;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .error-message {
            background-color: #ff4444;
            color: #fff;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo">Linha de Fundo</div>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="noticias.php">Notícias</a></li>
                <li><a href="sobre_nos.php">Sobre Nós</a></li>
                <li><a href="noticias.php" class="btn-adicionar">← Voltar</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="form-container">
            <h1 style="text-align: center; color: #00ff5f; margin-bottom: 30px;">Adicionar Nova Notícia</h1>

            <?php
            // Incluir conexão
            require_once 'conexao.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Coletar dados do formulário
                    $titulo = $_POST['titulo'] ?? '';
                    $resumo = $_POST['resumo'] ?? '';
                    $conteudo_completo = $_POST['conteudo_completo'] ?? '';
                    $categoria = $_POST['categoria'] ?? '';
                    $autor = $_POST['autor'] ?? '';
                    $fonte = $_POST['fonte'] ?? '';
                    $imagem = $_POST['imagem'] ?? '';
                    $em_destaque = isset($_POST['em_destaque']) ? 1 : 0;

                    // Validar campos obrigatórios
                    if (empty($titulo) || empty($resumo) || empty($conteudo_completo)) {
                        throw new Exception("Preencha todos os campos obrigatórios");
                    }

                    // Se fonte estiver vazia, usar valor padrão
                    if (empty($fonte)) {
                        $fonte = "Linha de Fundo";
                    }

                    // Inserir no banco de dados
                    $stmt = $pdo->prepare("INSERT INTO noticias (titulo, resumo, conteudo_completo, categoria, autor, fonte, imagem, em_destaque, data_publicacao) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                    
                    $stmt->execute([$titulo, $resumo, $conteudo_completo, $categoria, $autor, $fonte, $imagem, $em_destaque]);

                    echo '<div class="success-message">Notícia adicionada com sucesso!</div>';

                    // Limpar o formulário após sucesso
                    $_POST = array();

                } catch (Exception $e) {
                    echo '<div class="error-message">Erro ao adicionar notícia: ' . $e->getMessage() . '</div>';
                }
            }
            ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="titulo">Título *</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($_POST['titulo'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="resumo">Resumo *</label>
                    <textarea id="resumo" name="resumo" required><?php echo htmlspecialchars($_POST['resumo'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="conteudo_completo">Conteúdo Completo *</label>
                    <textarea id="conteudo_completo" name="conteudo_completo" required><?php echo htmlspecialchars($_POST['conteudo_completo'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
    <label for="categoria">Categoria *</label>
    <select id="categoria" name="categoria" required>
        <option value="">Selecione uma categoria</option>
        <option value="Libertadores" <?php echo ($_POST['categoria'] ?? '') === 'Libertadores' ? 'selected' : ''; ?>>Libertadores</option>
        <option value="Europa" <?php echo ($_POST['categoria'] ?? '') === 'Europa' ? 'selected' : ''; ?>>Europa</option>
        <option value="Seleção" <?php echo ($_POST['categoria'] ?? '') === 'Seleção' ? 'selected' : ''; ?>>Seleção</option>
        <option value="Brasileirão" <?php echo ($_POST['categoria'] ?? '') === 'Brasileirão' ? 'selected' : ''; ?>>Brasileirão</option>
        <option value="Copa do Brasil" <?php echo ($_POST['categoria'] ?? '') === 'Copa do Brasil' ? 'selected' : ''; ?>>Copa do Brasil</option>
        <option value="Estaduais" <?php echo ($_POST['categoria'] ?? '') === 'Estaduais' ? 'selected' : ''; ?>>Estaduais</option>
        <option value="Mercado da Bola" <?php echo ($_POST['categoria'] ?? '') === 'Mercado da Bola' ? 'selected' : ''; ?>>Mercado da Bola</option>
    </select>
</div>

                <div class="form-group">
                    <label for="autor">Autor *</label>
                    <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($_POST['autor'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="fonte">Fonte</label>
                    <input type="text" id="fonte" name="fonte" value="<?php echo htmlspecialchars($_POST['fonte'] ?? ''); ?>" placeholder="Deixe em branco para usar 'Linha de Fundo'">
                </div>

                <div class="form-group">
                    <label for="imagem">URL da Imagem</label>
                    <input type="url" id="imagem" name="imagem" value="<?php echo htmlspecialchars($_POST['imagem'] ?? ''); ?>" placeholder="https://exemplo.com/imagem.jpg">
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" id="em_destaque" name="em_destaque" value="1" <?php echo isset($_POST['em_destaque']) ? 'checked' : ''; ?>>
                    <label for="em_destaque">Destacar esta notícia</label>
                </div>

                <button type="submit" class="btn-submit">Publicar Notícia</button>
            </form>
        </div>
    </main>
</body>
</html>