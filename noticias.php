<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Notícias - Linha de Fundo</title>
</head>
<body>
    <header class="navbar">
        <div class="logo">Linha de Fundo</div>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="noticias.php" class="active">Notícias</a></li>
                <li><a href="sobre_nos.php">Sobre Nós</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <?php
        // Incluir conexão
        require_once 'conexao.php';
        
        try {
            // Buscar notícia em destaque
            $stmt_destaque = $pdo->prepare("SELECT * FROM noticias WHERE em_destaque = TRUE ORDER BY data_publicacao DESC LIMIT 1");
            $stmt_destaque->execute();
            $noticia_destaque = $stmt_destaque->fetch(PDO::FETCH_ASSOC);
            
            // Buscar outras notícias
            $stmt_noticias = $pdo->prepare("SELECT * FROM noticias WHERE em_destaque = FALSE ORDER BY data_publicacao DESC LIMIT 10");
            $stmt_noticias->execute();
            $noticias = $stmt_noticias->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e) {
            echo "<p style='color: red; text-align: center;'>Erro ao carregar notícias: " . $e->getMessage() . "</p>";
            $noticias = [];
            $noticia_destaque = null;
        }
        ?>

        <!-- Notícia em Destaque -->
        <?php if($noticia_destaque): ?>
        <section class="noticia-destaque">
            <div class="noticia-imagem">
                <img src="<?php echo htmlspecialchars($noticia_destaque['imagem']); ?>" alt="<?php echo htmlspecialchars($noticia_destaque['titulo']); ?>">
            </div>
            <div class="noticia-conteudo">
                <span class="categoria"><?php echo htmlspecialchars($noticia_destaque['categoria']); ?></span>
                <h1><?php echo htmlspecialchars($noticia_destaque['titulo']); ?></h1>
                <p class="data" data-timestamp="<?php echo $noticia_destaque['data_publicacao']; ?>">
                    <?php 
                    $data = new DateTime($noticia_destaque['data_publicacao']);
                    echo $data->format('d/m/Y H:i');
                    ?>
                </p>
                <p class="resumo"><?php echo htmlspecialchars($noticia_destaque['resumo']); ?></p>
                <div class="noticia-info">
                    <span class="autor">Por: <?php echo htmlspecialchars($noticia_destaque['autor']); ?></span>
                    <span class="fonte">Fonte: <?php echo htmlspecialchars($noticia_destaque['fonte']); ?></span>
                </div>
            </div>
        </section>
        <?php else: ?>
            <p style="text-align: center;">Nenhuma notícia em destaque no momento.</p>
        <?php endif; ?>

        <!-- Lista de Notícias Recentes -->
        <section class="noticias-recentes">
            <h2>Últimas Notícias</h2>
            <div class="lista-noticias">
                <?php if(count($noticias) > 0): ?>
                    <?php foreach($noticias as $noticia): ?>
                    <article class="noticia-pequena">
                        <img src="<?php echo htmlspecialchars($noticia['imagem']); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>">
                        <div class="conteudo">
                            <span class="categoria"><?php echo htmlspecialchars($noticia['categoria']); ?></span>
                            <h3><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars($noticia['resumo']); ?></p>
                            <span class="data-pequena" data-timestamp="<?php echo $noticia['data_publicacao']; ?>">
                                <?php 
                                $data = new DateTime($noticia['data_publicacao']);
                                echo $data->format('d/m/Y H:i');
                                ?>
                            </span>
                        </div>
                    </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center;">Nenhuma notícia encontrada.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script>
        function atualizarTempoRelativo() {
            const elementosData = document.querySelectorAll('[data-timestamp]');
            
            elementosData.forEach(elemento => {
                const timestamp = elemento.getAttribute('data-timestamp');
                const dataPublicacao = new Date(timestamp);
                const agora = new Date();
                
                const diferencaMs = agora - dataPublicacao;
                const diferencaMinutos = Math.floor(diferencaMs / (1000 * 60));
                const diferencaHoras = Math.floor(diferencaMs / (1000 * 60 * 60));
                const diferencaDias = Math.floor(diferencaMs / (1000 * 60 * 60 * 24));
                
                let texto = '';
                
                if (diferencaMinutos < 1) {
                    texto = 'Agora mesmo';
                } else if (diferencaMinutos < 60) {
                    texto = `Há ${diferencaMinutos} minuto${diferencaMinutos > 1 ? 's' : ''}`;
                } else if (diferencaHoras < 24) {
                    texto = `Há ${diferencaHoras} hora${diferencaHoras > 1 ? 's' : ''}`;
                } else {
                    texto = `Há ${diferencaDias} dia${diferencaDias > 1 ? 's' : ''}`;
                }
                
                elemento.textContent = texto;
            });
        }

        document.addEventListener('DOMContentLoaded', atualizarTempoRelativo);
        setInterval(atualizarTempoRelativo, 60000);
    </script>
</body>
</html>