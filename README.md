# PHP_LARAVEL12_GEO_GENIUS

Laravel 12 based Geo Genius project with **Multi-Language**, **Role & Permission**, and **Geo-based services**, built using a **Modular + Service Oriented Architecture**.

---

## Step 1: Install Fresh Laravel 12 Application

Open Terminal / Command Prompt and run:

```bash
composer create-project laravel/laravel:^12.0 PHP_LARAVEL12_GEO_GENIUS
```

Move into the project directory:

```bash
cd PHP_LARAVEL12_GEO_GENIUS
```

Generate application key:

```bash
php artisan key:generate
```

### Explanation

* Installs a clean Laravel 12 project
* Application key is required for encryption and security

---

## Step 2: Configure Environment & Database

Open `.env` file and update database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=geo_genius
DB_USERNAME=root
DB_PASSWORD=
```

Save the file.

Run migrations:

```bash
php artisan migrate
```

### Explanation

* `.env` manages environment-level configuration
* Migrations create required database tables

---

## Step 3: Language & Localization Setup

Create language file:

```
resources/lang/en/messages.php
```

```php
<?php

return [
    'welcome_message' => 'Welcome to Geo Genius',
];
```

---

## Step 4: Language Test Route

Add route in `routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;
use Devrabiul\LaravelGeoGenius\Services\TimezoneService;
use function Devrabiul\LaravelGeoGenius\geniusTrans;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/geo-test', function () {
    return [
        'ip'        => laravelGeoGenius()->geo()->getClientIp(),
        'country'   => laravelGeoGenius()->geo()->getCountry(),
        'timezone'  => laravelGeoGenius()->geo()->getTimezone(),
        'latitude'  => laravelGeoGenius()->geo()->getLatitude(),
        'longitude' => laravelGeoGenius()->geo()->getLongitude(),
    ];
});

Route::get('/timezone-test', function () {
    $tz = new TimezoneService();

    return [
        'user_timezone' => $tz->getUserTimezone(),
        'converted_time' => $tz->convertToUserTimezone(now()),
    ];
});

Route::get('/lang-test', function () {
    return __('welcome_message');
});

Route::get('/change-lang/{lang}', function ($lang) {
    laravelGeoGenius()->language()->changeUserLanguage($lang);
    return redirect()->back();
});

Route::get('/phone', function () {
    return view('phone');
});

```

### Explanation

* Laravel uses file-based localization
* `messages.welcome_message` maps to `messages.php`

---

## Step 5: Language Change Route

```php
Route::get('/change-lang/{lang}', function ($lang) {
    laravelGeoGenius()->language()->changeUserLanguage($lang);
    return redirect()->back();
});
```
<img width="981" height="312" alt="image" src="https://github.com/user-attachments/assets/aa3e4e51-1264-4189-8fbc-c637c7b0af36" />


### Explanation

* Changes user language dynamically
* Language stored in session or database
* Page reloads with selected language

---

## Step 6: Run Laravel 12 Project

Start development server:

```bash
php artisan serve
```

Open browser:

```
http://127.0.0.1:8000
```

<img width="1284" height="639" alt="image" src="https://github.com/user-attachments/assets/1fed69c8-535d-49cc-88e0-dc1d845e459f" />

```bash
http://127.0.0.1:8000/geo-test
```
<img width="846" height="399" alt="image" src="https://github.com/user-attachments/assets/1e4a6a2c-82a6-41f5-8858-010fd6a477a2" />

```bash
http://127.0.0.1:8000/timezone-test
```
<img width="1001" height="371" alt="image" src="https://github.com/user-attachments/assets/34d8008b-7009-4a2f-93e5-8818aa672dbf" />

```bash
http://127.0.0.1:8000/lang-test
```
<img width="790" height="353" alt="image" src="https://github.com/user-attachments/assets/652b235d-2489-46c9-a3e8-cdf77e978593" />

```php
http://127.0.0.1:8000/phone
```
<img width="1005" height="304" alt="image" src="https://github.com/user-attachments/assets/0e0b72ed-9c08-4060-b39b-17e1b957e270" />

# Explenation:

* Language changes dynamically
* Role-based APIs return secured data
* Scalable & production-ready architecture
* Clean Laravel 12 best practices followed


## Project Folder Structure

```
PHP_LARAVEL12_GEO_GENIUS
├── app/
│   ├── Services/
│   ├── Helpers/
│   └── Http/
│
├── resources/
│   └── lang/
│       └── en/
│           └── messages.php
│
├── routes/
│   ├── web.php
│  
│
├── database/
│   └── migrations/
│
├── .env
├
└──artisan
```




