<?php

namespace Thiagoprz\Lgpd\Http\Controllers;

use App\Models\LgpdUserAcceptance;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Thiagoprz\CrudTools\Http\Controllers\ControllerCrud;

/**
 * Class LgpdTermItemController
 * @package App\Http\Controllers
 */
class LgpdUserAcceptanceController extends BaseController
{
    use ValidatesRequests, ControllerCrud;

    /**
     * CRUD model class
     */
    public $modelClass = LgpdUserAcceptance::class;

    /**
     * Controller constructor
     */
    public function __construct()
    {
        // Uncomment if you are not using the Logable trait on the model class
        $this->disableLogs = true;
    }

}
