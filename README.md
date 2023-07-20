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

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Deployment Guide

In order to proceed with deployment, make sure the server has the following prerequisites installed.
- **OS Ubuntu 22.4**
- **Web Server Apache/2.4.52 (Ubuntu) with mod-rewrite enabled**
- **PHP 8.1.2**
- **MySQL 8.0.33**
- **Composer 2.5.8**
- **NodeJS 18.16.0**

**Required PHP Extensions**

- BCMath
- Ctype
- cURL
- DOM
- Fileinfo
- JSON
- Mbstring
- OpenSSL

After making sure all the above things, proceed with the below steps:

1. Connect the server using SSH and navigate to **/var/www/html** directory using **cd /var/www/html** command.
2. Clone GitHub repository or upload project files via FTP/SFTP in the server root directory i.e **/var/www/html**
3. Execute the command **cp .env.example .env**
4. Open .env file using **nano .env** command and provide Database and all other necessary credentials and save the file.
5. Execute the command **composer install** (This will install all PHP dependencies required by Laravel 10)
6. Execute the command **php artisan key:generate**
7. Execute the command **php artisan migrate --seed** (This will create all the tables in the Database and add some necessary data required to fresh start the project)
8. Execute the command **php artisan storage:link**
9. Set the necessary permissions to folders.
10. Execute **chown -R www-data:www-data /var/www/html**
11. Execute **chmod -R 775 /var/www/html/storage**
12. Execute **chmod -R 775 /var/www/html/bootstrap/cache**
13. Make sure that the project root directory is set to **/var/www/html/public** (This is required by Laravel so that you don't have to write /public in the URL)

Now we need to install and set up **pm2** to run a process in the background, this requires running notification and Stripe webhook handling, so follow the below steps:
- Install **pm2** by executing **npm install -g pm2** command. _(Make sure NodeJS 18 is installed)_
- You should have **queue-worker.yml** file in **/var/www/html** directory so start queue worker by executing **pm2 start /var/www/html/queue-worker.yml** command

Now go to your browser and open your website.

**That's All**


