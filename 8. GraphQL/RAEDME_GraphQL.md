## Creamos el proyecto en laravel 
```bash
composer create-project laravel/laravel laravel-graphql
```
## Instalamos el paquete de GraphQL
```bash
composer require rebing/graphql-laravel
```
## Creamos migrations 
```bash
php artisan make:migration create_users_table
```
## Instalamos el paquete de Lighthouse
```bash 
composer require nuwave/lighthouse
```
## Publicamos el esquema de Lighthouse
```bash
php artisan vendor:publish --tag=lighthouse-schema
```