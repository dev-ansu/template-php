# Mini-framework PHP


## Este é um projeto pessoal de um mini-framework PHP

### Tecnologias

- PHP;
- PHP-DI (para injeção de dependências);
- PHINX (para migrations e seeds);
- Tailwind e Boostrap (para estilização)


### Funcionalidades

- Sistema de rotas (GET e POST);
- Sistema de rotas agrupadas;
- Envio de middlewares para as rotas;
- Criação de migrações com PHINX;
- Uso de múltiplos bancos de dados;

### INSTALAÇÃO

#1 - Clone o repositório
```
git clone
```
#2 - Instale as dependências 
```
composer install
```
#3 - Inicie o PHINX
```
composer phinx init
```
#4 - Execute as migrações
```
composer phinx migrate
```
#5 - Execute as seeds
```
composer phinx seed:run
```
#6 - Inicie o servidor PHP
```
php -S localhost:3000
```
