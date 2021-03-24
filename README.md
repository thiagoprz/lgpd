LGPD Laravel Package
=
LGPD support package for Laravel

Installation
--

`` composer require thiagoprz/lgpd ``

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
Route::resource('lgpdterm', 'Thiagoprz\Lgpd\Http\Controllers\LgpdTermController');
Route::resource('lgpdtermitem', 'Thiagoprz\Lgpd\Http\Controllers\LgpdTermItemController');
Route::resource('lgpduseracceptance', 'Thiagoprz\Lgpd\Http\Controllers\LgpdUserAcceptanceController');

```

* Publish CRUD views to implement forms and management of the Terms and acceptance items.
  
`` php artisan vendor:publish --provider="Thiagoprz\Lgpd\LgpdServiceProvider"``

Views will be stored in ``resources/views/vendor/lgpd``.


Tables
--

* lgpd_terms: LGPD terms

  | Column          | Type      | Description                                                        | Nullable |
  | ------          | --------- | -------------------                                                | --- |
  | id              |  bigint   | ID (auto increment)                                                | No  |
  | term            |  text     | Terms text                                                         | No  |
  | publishing_date | datetime  | Date and time when the version of the terms will become mandatory  | No  |
  | version         | varchar   | Version of the terms                                               | Yes |
  | created_at      | datetime  | Date and time of creation                                          | No  |
  | updated_at      | datetime  | Date and time of last update                                       | Yes |
  
* lgpd_term_items: LGPD terms acceptance items

  | Column          | Type          | Description                                                        | Nullable |
  | ------          | ---------     | -------------------                                                | --- |
  | id              | bigint        | ID (auto increment)                                                | No  |
  | lgpd_term_id    | bigint        | Term ID                                                            | No  |
  | term            | varchar(400)  | Acceptance term text                                               | No  |
  | created_at      | datetime      | Date and time of creation                                          | No  |
  | updated_at      | datetime      | Date and time of last update                                       | Yes |
  
* lgpd_user_acceptance: Record of acceptance by the user

  | Column          | Type          | Description                                                        | Nullable |
  | ------          | ---------     | -------------------                                                | --- |
  | id              | bigint        | ID (auto increment)                                                | No  |
  | lgpd_term_id    | bigint        | Term ID                                                            | No  |
  | user_id         | bigint        | User ID                                                            | No  |
  | created_at      | datetime      | Date and time of creation                                          | No  |
  | updated_at      | datetime      | Date and time of last update                                       | Yes |


Goal
--
The goal of the project is to allow the creation of a text of terms and to contain one or more accepted ones containing the specificities of the terms presented. For example: in projects that have financial transactions it will often be necessary to indicate the terms of use of the tool itself plus the terms of use of the gateway or bank linked to the collection and payment process, these two terms can be presented together but ideally the system needs specify that the clauses of each have been accepted by the user.
