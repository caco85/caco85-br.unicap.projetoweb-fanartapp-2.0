<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
# Vue 3 + Vite

This template should help get you started developing with Vue 3 in Vite. The template uses Vue 3 `<script setup>` SFCs, check out the [script setup docs](https://v3.vuejs.org/api/sfc-script-setup.html#sfc-script-setup) to learn more.


Projeto Fanart Refatorado e feito em novo modelo Full Stack Laravel, VueJs e Tailwind css banco de Dados phpmyadmin

Feito a Api com laravel
Front com Vue+ Vuex
Tailwind css
e Vite.


Como clonar e rodar o projeto
Run: git clone https://github.com/caco85/br.unicap.projetoweb-fanartapp-2.0.git

baixe e instale o xammp https://www.apachefriends.org/pt_br/download.html
baixei o composer https://getcomposer.org/

Run: composer global require laravel/installer

Preparando o banco , apos instalar o xampp iniciei o apache mysql

Run: cd br.unicap.projetoweb-fanartapp-2.0

caso der erro no config env execute

Run: copy .env.example .env

Run: php artisan cache:clear

Run: php artisan config:clear

Run: php artisan key:generate


abra seu .env e add seu DB_DATABASE=fanart_2

parar criar  o banco
Run: php artisan migrate --seed

para ativar a leitura de suas imagens

php artisan storage:link

apos criar o banco, execute a Api

php artisan serve

apos isto de um Run: cd ..
depois 
Run: cd vue
apos isto execute a sua aplicação vue

npm rum dev 
e abra o http://localhost:3000/





