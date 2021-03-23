<?php

namespace Thiagoprz\Lgpd\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Thiagoprz\CrudTools\Http\Controllers\ControllerCrud;
use Thiagoprz\Lgpd\Models\LgpdTermItem;

/**
 * Class LgpdTermItemController
 * @package App\Http\Controllers
 */
class LgpdTermItemController extends BaseController
{
    use ValidatesRequests, ControllerCrud;

    /**
     * CRUD model class
     */
    public $modelClass = LgpdTermItem::class;

    /**
     * Controller constructor
     */
    public function __construct()
    {
        // Uncomment if you are not using the Logable trait on the model class
        $this->disableLogs = true;
    }

}
