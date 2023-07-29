Comandos para iniciar o projeto:

Renomeie o .env.example para .env, e edit a parte do banco de dados de acordo com o seu banco.

1 - composer install
2 - php artisan migrate --seed
3 - php artisan test

Para testar a API deixe o server rodando -> php artisan serve