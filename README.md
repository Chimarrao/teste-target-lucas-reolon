<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Projeto de Web Service REST com Laravel

Este projeto é um Web Service REST desenvolvido em Laravel que permite a autenticação de usuários via JWT, CRUD de usuários e endereços, além da atribuição de permissões.

### Funcionalidades

1. **Autenticação (JWT)**
2. **Criar Usuário**
3. **Editar Usuário**
4. **Deletar Usuário (Logicamente)**
5. **Exibir Dados do Usuário**
6. **Atribuição de Permissão**
7. **Armazenar Registros de Endereço**

### Dados do Usuário

- Nome
- E-mail
- Telefone
- CPF

### Dados de Endereço

- Logradouro
- Número
- Bairro
- Complemento
- CEP

### Requisitos da Implementação

1. Utilização de PHP 7 com Laravel.
2. Arquitetura REST.
3. Testes unitários para validação do CRUD.

### Como Iniciar o Projeto

1. Clone o repositório:
    ```bash
    git clone https://github.com/seu-usuario/seu-repositorio.git
    cd seu-repositorio
    ```

2. Instale as dependências do Composer:
    ```bash
    composer install
    ```

3. Copie o arquivo `.env.example` para `.env`:
    ```bash
    cp .env.example .env
    ```

4. Gere a chave da aplicação:
    ```bash
    php artisan key:generate
    ```

5. Configure o banco de dados no arquivo `.env`.

6. Execute as migrações:
    ```bash
    php artisan migrate
    ```

7. Inicie o servidor de desenvolvimento:
    ```bash
    php artisan serve
    ```

8. Execute os testes para garantir que tudo está funcionando:
    ```bash
    php artisan test
    ```