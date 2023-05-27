<!-- # Projek Kemenkopukm

### Petunjuk Untuk Instalasi Awal
- Pastikan anda berada di branch `develop`
- Setelah selesai clone, Konfigurasikan file `.env` anda. Copy dan adapatasikan dari file `.env.example` . Sesuaikan konfigurasi database anda dengan konfigurasi lokal anda.
- Jalankan `composer install` (sekali, Dapat anda jalankan lagi jika ada perubahan difile `composer.json`)
- Generate File `php artisan key:generate`
- Generate Table DB `php artisan migrate:fresh --seed`
- Generate Storage link `php artisan storage:link`
- Jalankan Local Server Anda `php artisan serve`
- Akses Aplikasi melalui local url anda.

### Sitemap Kemenkopukm
- Halaman Depan `/`
- Halaman Admin `/backoffice`
- Halaman Login `/backoffice/login`
- Halaman Pendaftaran `/backoffice/register` (sementara bisa diakses)
- Halaman Debug Sistem `/telescope` (Jika Di aktifkan, lihat file `.env.example` dan [Laravel Telescope](https://laravel.com/docs/8.x/telescope))

### Petunjuk Frontend (Opsional, Jika tidak mengubah css/js. Abaikan Section ini.)
- Baik Halaman Frontend atau Admin menggunakan [Laravel Mix](https://laravel.com/docs/8.x/mix) untuk assets management
- Frontend Style `resources/sass/public/main-style.scss` & Script `resources/js/public/main-script.js`
- Backend Style `resources/sass/backoffice-style.scss` & Script `resources/js/backoffice-script.js`
- Untuk Pertama Kali Jalankan `npm install`
- Untuk mencompile assets ke production version jalankan `npm run prod` dan `npm run watch` untuk local development -->

<!-- space-space-space -->

# Go-Jariyah ~ Jariyah-Fund ~ Go-Fund

## Prequisite
- Project using laravel 10
- Make sure XAMPP / MAMP / Laragon with php version > 8 installed first

## Installation
- Clone this repository
- Checkout to branch `intern`
- If Directory `/vendor` included while cloning and make some error, delete `vendor` directory, then
- Run `composer install`
- Run `php artisan key:generate`
- Setup database, `you can ask other developer to get local dummy database`
- Run `php artisan storage:link`
- Run `php artisan serve`

## Sitemap
### Admin
- Access login page `{url}/admin`
- Access dashboard (auth:admin) `{url}/admin/dashboard`

### Anggota
- Access login page `{url}/`
- Access dashboard (auth:user) `{url}/anggota/dashboard`

<!-- space-space-space -->

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel 
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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

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

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
