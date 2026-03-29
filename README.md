# 🎯 Sistema de Gerenciamento de Metas (CRUD)

Um sistema web completo, desenvolvido em PHP e MySQL, focado na gestão de objetivos pessoais. Este projeto foi arquitetado com princípios de **Alta Performance**, segurança de dados, **Experiência do Usuário (UX)** e **Infraestrutura como Código (IaC)**.

## 🚀 Funcionalidades

- **C (Create):** Cadastro de novas metas com validação de dados.
- **R (Read):** Painel interativo com listagem cronológica, conversão de datas (Formato BR) e **Barra de Progresso Visual** com cores dinâmicas.
- **U (Update):** Sistema de edição com preenchimento automático e **Slider Interativo** para atualização de progresso (0% a 100%).
- **D (Delete):** Exclusão segura de registros via parâmetros de URL (GET) com feedback visual.
- **Notificações Inteligentes:** Sistema de _Flash Messages_ via sessão PHP, sem uso de pop-ups intrusivos.
- **Auto-Build de Infraestrutura:** O banco de dados e as tabelas nascem automaticamente na primeira inicialização da máquina via Docker.

## 🛠️ Tecnologias Utilizadas

**Front-end (A Vitrine):**

- HTML5 & CSS3
- Bootstrap 5.3 (Componentes responsivos, Progress Bars, Sliders, Badges)
- Arquitetura Modular (Inclusão dinâmica de Cabeçalho e Rodapé via PHP)

**Back-end (O Motor):**

- PHP 8.2
- Gestão de Estado com `$_SESSION`
- PDO (PHP Data Objects) para conexão segura.
- Prevenção de SQL Injection através de `bindParams`.

**Infraestrutura & Banco de Dados (O Chassi):**

- MySQL 8.0
- Docker & Docker Compose (Portabilidade total)
- phpMyAdmin (Gestão visual do banco)

## ⚙️ Como Executar o Projeto

Graças à conteinerização, você pode rodar este projeto em qualquer computador sem precisar instalar PHP ou MySQL diretamente na sua máquina.

### Pré-requisitos

- [Docker](https://www.docker.com/) instalado e rodando.
- [Docker Compose](https://docs.docker.com/compose/) instalado.

### Passo a Passo

1. Clone este repositório:
   git clone [https://github.com/MarceloMJ7/projetoMetas.git]

2. Acesse a pasta do projeto via terminal:
   cd projetoMetas/docker

3. Ligue os motores da aplicação:
   docker-compose up -d --build

4. Acesse no seu navegador:
   Painel da Aplicação: http://localhost:8888
   Gerenciador de Banco (phpMyAdmin): http://localhost:8081 (User: root | Senha: root)
   Nota de Arquitetura: O script init.sql rodará automaticamente no primeiro build, criando a estrutura completa com suporte a rastreamento de progresso.

👨‍💻 Autor
Desenvolvido por Marcelo - Em transição para a Engenharia de Software.
