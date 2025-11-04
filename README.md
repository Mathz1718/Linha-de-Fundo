⚽ Guia de Contribuição — Projeto Linha de Fundo
Este guia explica como clonar o repositório, editar o projeto no VS Code e trabalhar com o fluxo de branches (dev e feature) usado no nosso time.
Siga esses passos pra manter o código sempre organizado e atualizado. 💪

🧭 1️⃣ Clonar o repositório
Instale o Git (se ainda não tiver)
👉 https://git-scm.com/downloads

Depois de instalar, confirme:

bash
git --version
Clone o repositório do projeto
Escolha uma pasta no seu computador (ex: Documentos/Projetos) e execute:

bash
git clone https://github.com/Mathz1718/Linha-de-Fundo.git
Entre na pasta:
bash
cd Linha-de-Fundo
💻 2️⃣ Abrir o projeto no VS Code
Se tiver o Visual Studio Code instalado, abra o projeto com:

bash
code .
(o ponto . significa "abrir esta pasta")

🌱 3️⃣ Criar e usar a branch de desenvolvimento (dev)
A branch dev é onde todo o desenvolvimento acontece.
Antes de começar a programar, sempre garanta que está na dev e com ela atualizada.

Criar a branch dev (só precisa fazer uma vez)
bash
git checkout -b dev
git push origin dev
Mudar para a branch dev
bash
git checkout dev
Atualizar com as últimas alterações do GitHub
bash
git pull origin dev
🧩 4️⃣ Criar uma branch para sua funcionalidade (feature)
Sempre que for adicionar algo novo (ex: nova página, correção ou estilo),
crie uma branch própria, derivada da dev.

bash
git checkout -b feature/nome-da-tarefa
Exemplo:

bash
git checkout -b feature/aba-noticias
Agora você pode editar o código à vontade no VS Code 🎨

💾 5️⃣ Fazer commit e enviar suas mudanças
Depois de terminar suas alterações:

bash
git add .
git commit -m "Adicionei a aba de notícias e melhorei o CSS"
git push origin feature/aba-noticias
🔁 6️⃣ Criar um Pull Request (PR)
Vá até o repositório no GitHub

Clique em "Compare & pull request"

Selecione o destino:

base branch: dev

compare branch: feature/aba-noticias

Escreva uma breve descrição do que mudou

Clique em "Create pull request"

Após revisão, o código será mesclado na dev.

🚀 7️⃣ Mesclar da dev para main
Quando tudo estiver testado e pronto para publicação:

bash
git checkout main
git pull origin main
git merge dev
git push origin main
🧱 Fluxo de trabalho visual
text
main ───► versão estável (publicação)
   ▲
   │
   └── dev ───► branch de desenvolvimento
          │
          ├── feature/noticias
          ├── feature/css-ajustes
          └── feature/banco-dados
✅ Resumo rápido
Etapa	Comando principal	Descrição
Clonar projeto	git clone URL	Baixa o repositório
Entrar na pasta	cd Linha-de-Fundo	Acessa o projeto
Criar branch dev	git checkout -b dev	Cria a branch de desenvolvimento
Nova funcionalidade	git checkout -b feature/nome	Cria sua branch de trabalho
Enviar mudanças	git push origin feature/nome	Sobe para o GitHub
Atualizar código	git pull origin dev	Pega as últimas atualizações
Finalizar e publicar	git merge dev → main	Junta tudo na versão final
⚠️ Dicas importantes
Sempre use nomes de branches curtos e descritivos

Exemplos: feature/aba-noticias, fix/footer, ajustes-css

Mantenha sua branch atualizada com a dev regularmente

Escreva mensagens de commit claras e objetivas

🎯 Pronto! Agora você está preparado para contribuir com o projeto!
