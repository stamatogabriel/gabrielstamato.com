# GabrielStamato.com

Blog e portfólio pessoal em WordPress, rodando localmente com Docker e sustentado por um child theme próprio, o `astradev`.

O ponto central deste repositório não é apenas "ter um site em WordPress". O diferencial está na construção manual do tema: layouts, templates, estilos e comportamentos foram escritos diretamente em PHP, CSS e JavaScript sobre a base do Astra, sem depender de page builders para montar a experiência principal.

## Visão Geral

Este projeto reúne:

- WordPress rodando em ambiente Docker
- Tema base `Astra`
- Child theme autoral `astradev`
- Plugins instalados e versionados no próprio repositório
- Uploads e customizações persistidos localmente
- Scripts auxiliares para setup e ajustes operacionais

## O Que Foi Feito Manualmente

O `astradev` foi desenvolvido de forma manual para transformar o Astra em um site com identidade própria.

Isso inclui:

- `front-page.php` com hero, apresentação, experiências e blocos de portfolio
- `home.php` para a listagem principal do blog
- `single.php` com experiência editorial customizada para leitura de posts
- `archive.php` e `search.php` para navegação de conteúdo
- `page-contact.php` com formulário e bloco de contato próprios
- `functions.php` com helpers, enqueue de assets, tempo de leitura e ajustes de comportamento
- `assets/js/astradev.js` com dark mode, progresso de leitura, copiar link, sumário automático e interações visuais
- `style.css` com design tokens, identidade visual e camada completa de estilo do child theme

Em outras palavras: o Astra entra como base estrutural, mas a experiência do site foi moldada na mão.

## Filosofia Do Projeto

Este repositório segue uma linha simples:

- usar WordPress como CMS maduro e pragmático
- usar o Astra como fundação sólida
- construir o template manualmente para manter controle real sobre markup, performance e identidade visual

A decisão aqui não foi terceirizar a interface para um construtor visual, e sim tratar o tema como software: com templates versionados, comportamento explícito e customização feita em código.

## Estrutura Principal

```text
.
├── Dockerfile
├── docker-compose.yml
├── plugins/
├── themes/
│   ├── astra/
│   └── astradev/
├── uploads/
├── setup_eu_smtp.php
└── .tmp_ml_setup.php
```

### Pastas E Arquivos Importantes

- `themes/astradev/`: child theme customizado do projeto
- `themes/astra/`: tema base usado como fundação
- `plugins/`: plugins instalados e mantidos no repositório
- `uploads/`: assets persistidos do WordPress
- `docker-compose.yml`: sobe WordPress + MySQL para desenvolvimento local
- `Dockerfile`: customiza a imagem do WordPress com WP-CLI, extensões e ajustes de PHP
- `setup_eu_smtp.php`: script utilitário para configuração SMTP
- `.tmp_ml_setup.php`: script auxiliar para ajustes de conteúdo e idioma

## Stack

- WordPress
- PHP 8.5
- Apache
- MySQL 8
- Docker / Docker Compose
- Astra Theme
- Child Theme customizado em PHP, CSS e JavaScript

## Ambiente Local

O projeto já está preparado para rodar com Docker.

### Subir o ambiente

```bash
docker compose up --build
```

Depois disso, o WordPress fica disponível em:

```text
http://localhost:8080
```

### Serviços configurados

- `wordpress`: aplicação WordPress servida em `localhost:8080`
- `db`: MySQL 8 com persistência local em `.docker/db_data`

### Volumes montados

As principais pastas do `wp-content` estão montadas localmente:

- `./themes`
- `./plugins`
- `./uploads`

Isso permite editar tema, plugins e arquivos persistidos diretamente no repositório, com reflexo imediato no container.

## Destaques Técnicos Do Tema

O `astradev` foi pensado para funcionar como um child theme de verdade, não só como uma camada de CSS por cima do Astra.

Entre os pontos mais relevantes:

- carregamento controlado de assets via `functions.php`
- dark mode persistido em `localStorage`
- barra de progresso de leitura para posts
- cálculo de tempo estimado de leitura
- botão de copiar link do artigo
- geração automática de sumário com base nos headings do conteúdo
- templates dedicados para home, single, archive, search e contato
- front page com abordagem de portfólio técnico e posicionamento pessoal

## Plugins

O repositório carrega uma coleção já instalada de plugins WordPress para SEO, cache, formulários, SMTP, segurança, analytics e utilidades.

Alguns exemplos visíveis na estrutura atual:

- `akismet`
- `all-in-one-wp-migration`
- `classic-editor`
- `ewww-image-optimizer`
- `google-site-kit`
- `really-simple-ssl`
- `seo-by-rank-math`
- `wp-mail-smtp`
- `wp-super-cache`
- `wpforms-lite`
- `wps-hide-login`

## Setup E Scripts Auxiliares

Além do tema, o repositório contém scripts utilitários para tarefas operacionais específicas, como:

- configuração de SMTP
- suporte a conteúdo multilíngue
- ajustes automatizados de páginas, posts e menus

Eles complementam o fluxo de manutenção do site, mas o coração do projeto continua sendo o tema manualmente construído.

## Por Que Isso Importa

Muita customização em WordPress acaba escondida atrás de builders, painéis e plugins que tornam o resultado difícil de versionar e manter.

Aqui a proposta é outra:

- o layout principal está em código
- os templates estão legíveis no repositório
- o comportamento da interface está explícito
- a identidade visual não depende de arrastar bloco

Esse projeto valoriza a construção manual do template porque isso entrega mais controle, previsibilidade e clareza técnica.

## Próximos Passos Naturais

Algumas evoluções que fazem sentido para este repositório:

- documentar o fluxo de instalação inicial do WordPress após subir os containers
- adicionar screenshots do tema em funcionamento
- separar melhor quais plugins são essenciais e quais são opcionais
- remover segredos sensíveis de scripts auxiliares e migrá-los para variáveis de ambiente

## Autor

Gabriel Stamato

- GitHub: https://github.com/stamatogabriel
- LinkedIn: https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/
