<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# 🎟️ Passaporte.io

Sistema de Gestão de Eventos e Ingressos desenvolvido com Laravel e DaisyUI.

---

## 🚀 Tecnologias Utilizadas

* PHP 8.4
* Laravel 13
* Blade
* Tailwind CSS
* DaisyUI
* SQLite
* Eloquent ORM

---

## 🧠 Como o Projeto Funciona

O Passaporte.io foi desenvolvido seguindo o padrão MVC (Model - View - Controller), permitindo uma organização clara do código e facilitando a manutenção da aplicação.

### Model

Responsável pela comunicação com o banco de dados.

Funções principais:

* Persistência de dados
* Relacionamentos entre entidades
* Regras de negócio relacionadas ao banco

Principais Models:

* User
* Event
* Category
* EventUser (tabela pivô)

### View

Responsável pela interface visual do sistema.

Utiliza:

* Blade Templates
* Tailwind CSS
* DaisyUI

Funções:

* Exibição dos eventos
* Formulários
* Mensagens de feedback
* Navegação entre páginas

### Controller

Responsável por controlar o fluxo da aplicação.

Funções:

* Receber requisições
* Validar dados
* Executar regras de negócio
* Retornar as views corretas

---

## 🗄️ Banco de Dados

O sistema utiliza SQLite juntamente com o Eloquent ORM do Laravel.

### Tabelas Principais

#### users

* id
* name
* email
* password
* role

#### categories

* id
* name

#### events

* id
* user_id
* category_id
* title
* description
* date_time
* location
* capacity
* banner_path

#### event_user

Tabela pivô responsável pelas inscrições.

* id
* user_id
* event_id
* ticket_code
* status
* timestamps

---

## 🔗 Relacionamentos

### User → Events

Um organizador pode criar vários eventos.

```php
User hasMany Events
```

### Event → User

Cada evento pertence a um organizador.

```php
Event belongsTo User
```

### Event → Category

Cada evento pertence a uma categoria.

```php
Event belongsTo Category
```

### User ↔ Event

Relacionamento muitos para muitos através da tabela event_user.

```php
belongsToMany()
```

---

## 👥 Perfis do Sistema

### Visitante

Pode:

* Visualizar eventos
* Filtrar eventos por categoria
* Visualizar detalhes dos eventos
* Criar conta
* Fazer login

Não pode:

* Inscrever-se em eventos
* Acessar área administrativa

---

### Participante

Pode:

* Visualizar eventos
* Inscrever-se em eventos
* Cancelar inscrições
* Consultar histórico de ingressos

Não pode:

* Criar eventos
* Editar eventos
* Excluir eventos

---

### Organizador

Pode:

* Criar eventos
* Editar seus próprios eventos
* Excluir seus próprios eventos
* Gerenciar eventos pelo painel administrativo

Não pode:

* Inscrever-se em eventos
* Alterar eventos de outros organizadores

---

## 🔐 Autenticação e Autorização

O sistema possui autenticação completa implementada manualmente com Laravel.

Funcionalidades:

* Cadastro
* Login
* Logout

Controle de acesso realizado através de Middlewares.

### OrganizerMiddleware

Permite acesso apenas para usuários com perfil Organizador.

### ParticipantMiddleware

Permite acesso apenas para usuários com perfil Participante.

---

## ⚙️ Funcionalidades Implementadas

### Portal Público

* Home pública
* Cards de eventos
* Filtro por categoria
* Página de detalhes do evento

### Gestão de Eventos

* Criar evento
* Editar evento
* Excluir evento
* Upload de banner

### Sistema de Inscrições

* Inscrição em eventos
* Geração automática de ticket
* Histórico de ingressos
* Cancelamento de inscrição

### Segurança

* CSRF Protection
* Middleware de autenticação
* Middleware de autorização
* Senhas criptografadas
* Foreign Keys

---

## 🎫 Sistema de Tickets

Ao realizar uma inscrição, o sistema gera automaticamente um código alfanumérico único.

Exemplo:

```txt
A7F9K2M4P8XZ
```

O ticket fica armazenado na tabela event_user e pode ser consultado posteriormente pelo participante.

---

## 🎨 Interface

Construída utilizando:

* Tailwind CSS
* DaisyUI

Componentes utilizados:

* Navbar
* Cards
* Alerts
* Forms
* Tables
* Buttons

Mensagens Flash:

```txt
alert-success
```

```txt
alert-error
```
---
🛠️ Instalação

Clonar o projeto:

git clone URL_DO_REPOSITORIO

Entrar na pasta:

cd passaporte.io

Instalar dependências:

composer install

Instalar dependências front-end:

npm install

Criar arquivo de ambiente:

cp .env.example .env

Gerar chave da aplicação:

php artisan key:generate

Executar migrations e seeders:

php artisan migrate:fresh --seed

Criar link simbólico para uploads:

php artisan storage:link

Iniciar servidor:

php artisan serve
👤 Contas de Teste
Organizador

Email:

organizador@passaporte.io

Senha:

12345678
Participante

Email:

participante@passaporte.io

Senha:

12345678

## 📚 Aprendizados

Durante o desenvolvimento deste projeto foram aplicados conceitos importantes de desenvolvimento web:

* Estrutura MVC
* Eloquent ORM
* Relacionamentos entre tabelas
* Autenticação e autorização
* Middleware
* Upload de arquivos
* Eager Loading
* Paginação
* Blade Components
* Integração Laravel + DaisyUI
* Regras de negócio e validações
* Segurança de aplicações web

---

## 👨‍💻 Autor

Gustavo Nicácio Ferreira

Projeto acadêmico desenvolvido para a disciplina de Desenvolvimento Web utilizando Laravel.

Documentação e apoio ao desenvolvimento com utilização de Inteligência Artificial.

2026.
