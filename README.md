LGPD Laravel Package
=

Installation
--

`` composer install thiagoprz/lgpd ``

* Add service provider (only if not using package auto discovery enabled) on config/app.php:


```
... 
'providers' => [
    ...
    \Thiagoprz\Lgpd\LgpdServiceProvider::class,
],
...
```


* Migrate tables: 


`` php artisan migrate ``


* Add routes for terms implementation (api.php or web.php):

```

// LGPD CRUD resources (GET, POST, PATCH and DELETE already implemented)
Route::resource('lgpdterm', Thiagoprz\Lgpd\Http\Controllers\LgdpTermController::class);
Route::resource('lgpdtermitem', Thiagoprz\Lgpd\Http\Controllers\LgdpTermItemController::class);

```

* Publish CRUD views to implement forms and management of the Terms and acceptance items.
  
`` php artisan vendor:publish --provider="Thiagoprz\Lgpd\LgpdServiceProvider"``

Views will be stored in ``resources/views/vendor/lgpd``.


Tables
--

* lgpd_terms: LGPD terms
* lgpd_term_items: LGPD terms acceptance items
* lgpd_user_acceptance: Record of acceptance by the user
