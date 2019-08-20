# To-do app built using Laravel and Vue.js
Developed by Juan Miguel de la Cruz, to view demo online, visit: http://52.36.196.162/

##Requirements

1. PHP >= 7.2
2. MySQL
3. Apache/nginx

##Build instructions

1. Extract clone repository
2. Run `composer install`
3. Run `php artisan key:generate`
4. Create `.env` file (copy from .env.example) and fill in with database credentials
5. Run `php artisan migrate`
6. Configure virtual hosts / web server (will depend on your setup). Can use this as reference: https://www.digitalocean.com/community/tutorials/how-to-deploy-a-laravel-application-with-nginx-on-ubuntu-16-04

This project was losely based on the following reference:
https://nick-basile.com/blog/post/testing-a-vuejs-and-laravel-todo-app