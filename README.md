# 🎯 Sistema de Gerenciamento de Metas (CRUD)

Um sistema web completo, desenvolvido em PHP e MySQL, focado na gestão de objetivos pessoais. Este projeto foi arquitetado com princípios de **Alta Performance**, segurança de dados e **Infraestrutura como Código (IaC)**.

## 🚀 Funcionalidades

- **C (Create):** Cadastro de novas metas com validação de dados.
- **R (Read):** Painel (Dashboard) interativo com listagem cronológica e conversão de datas (Formato BR).
- **U (Update):** Sistema de edição com preenchimento automático de formulário (Bancada de Retrabalho).
- **D (Delete):** Exclusão segura de registros via parâmetros de URL (GET) e proteção de execução.
- **Auto-Build de Infraestrutura:** O banco de dados e as tabelas são gerados automaticamente na primeira inicialização da máquina via Docker.

## 🛠️ Tecnologias Utilizadas

**Front-end:**
- HTML5 & CSS3
- Bootstrap 5.3 (Componentes responsivos, Cards, Badges)
- Arquitetura de CSS Scoping (Evita vazamento de estilos)

**Back-end:**
- PHP 8.2
- PDO (PHP Data Objects) para conexão segura.
- Prevenção de SQL Injection através de `bindParams`.
- Proteção contra XSS (Cross-Site Scripting) usando `htmlspecialchars()`.

**Infraestrutura & Banco de Dados:**
- MySQL 8.0
- Docker & Docker Compose (Portabilidade total)
- phpMyAdmin (Gestão visual do banco)

## ⚙️ Como Executar o Projeto

Graças à conteinerização, você pode rodar este projeto em qualquer computador (Windows, Mac ou Linux) sem precisar instalar o PHP ou o MySQL diretamente na sua máquina.

### Pré-requisitos
- [Docker](https://www.docker.com/) instalado e rodando.
- [Docker Compose](https://docs.docker.com/compose/) instalado.

### Passo a Passo

1. Clone este repositório:
```bash
git clone [https://github.com/MarceloMJ7/projetoMetas)
