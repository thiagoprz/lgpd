LGPD Laravel Package
=
Implementação da LGPD ligada ao cadastro de usuários do Laravel.

Instalação
--

`` composer require thiagoprz/lgpd ``

* Adicionar o service provider (apenas se não tiver o package auto discover habilitado) no arquivo config/app.php:


```
... 
'providers' => [
    ...
    \Thiagoprz\Lgpd\LgpdServiceProvider::class,
],
...
```


* Migrar as tabelas: 


`` php artisan migrate ``


* Adicionar as rotas para implementar os termos no seu projeto (api.php ou web.php):

```

// LGPD CRUD resources (GET, POST, PATCH e DELETE já implementados)
Route::resource('lgpdterm', 'Thiagoprz\Lgpd\Http\Controllers\LgpdTermController');
Route::resource('lgpdtermitem', 'Thiagoprz\Lgpd\Http\Controllers\LgpdTermItemController');
Route::resource('lgpduseracceptance', 'Thiagoprz\Lgpd\Http\Controllers\LgpdUserAcceptanceController');

```

* Publicas as views para poder implementar os formulários e telas de gestão dos termos e aceites necessários.
  
`` php artisan vendor:publish --provider="Thiagoprz\Lgpd\LgpdServiceProvider"``

As views estarão publicadas na pasta: ``resources/views/vendor/lgpd``.

Tables
--

* lgpd_terms: termos LGPD

  | Coluna          | Tipo          | Descrição                                                      | Nulo |
  | ------          | --------- | -------------------                                                | --- |
  | id              |  bigint   | ID (auto incremento)                                               | No  |
  | term            |  text     | Texto dos termos                                                   | No  |
  | publishing_date | datetime  | Data e hora em que os termos se tornarão obrigatórios              | No  |
  | version         | varchar   | Versão dos termos                                                  | Yes |
  | created_at      | datetime      | Data e hora da criação                                         | No  |
  | updated_at      | datetime      | Data e hora da última alteração                                | Yes |

* lgpd_term_items: aceites dos termos LGPD

  | Coluna          | Tipo          | Descrição                                                          | Nulo |
  | ------          | ---------     | -------------------                                                | --- |
  | id              | bigint        | ID (auto incremento)                                               | No  |
  | lgpd_term_id    | bigint        | ID do Termo                                                        | No  |
  | term            | varchar(400)  | Texto do aceite de termos                                          | No  |
  | created_at      | datetime      | Data e hora da criação                                             | No  |
  | updated_at      | datetime      | Data e hora da última alteração                                    | Yes |

* lgpd_user_acceptance: Registros de aceite dos usuários

  | Coluna          | Tipo          | Descrição                                                          | Nulo |
  | ------          | ---------     | -------------------                                                | --- |
  | id              | bigint        | ID (auto incremento)                                               | No  |
  | lgpd_term_id    | bigint        | ID do termo                                                        | No  |
  | user_id         | bigint        | ID do usuário                                                      | No  |
  | created_at      | datetime      | Data e hora da criação                                             | No  |
  | updated_at      | datetime      | Data e hora da última alteração                                    | Yes |


Objetivo
--
O objetivo do projeto é permitir criar um texto de termos e nele conter um ou vários aceites contendo as especificidades dos  termos apresentados. Por exemplo: em projetos que possuem transações financeiras muitas vezes será necessário indicar os termos de uso da própria ferramenta mais os termos de uso do gateway ou banco ligado ao processo de cobranças e pagamentos, estes dois termos podem ser apresentados juntos porém idealmente o sistema precisa especificar que as cláusulas de cada um foram aceitas pelo usuário.  
