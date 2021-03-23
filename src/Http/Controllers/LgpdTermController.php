<?php

namespace Thiagoprz\Lgpd\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Thiagoprz\CrudTools\Http\Controllers\ControllerCrud;
use Thiagoprz\Lgpd\Models\LgpdTerm;

/**
 * Class LgpdTermController
 * @package App\Http\Controllers
 */
class LgpdTermController extends BaseController
{
    use ValidatesRequests, ControllerCrud;

    /**
     * CRUD model class
     */
    public $modelClass = LgpdTerm::class;

    /**
     * Controller constructor
     */
    public function __construct()
    {
        // Uncomment if you are not using the Logable trait on the model class
        $this->disableLogs = true;
    }


    /**
     * @param false $forRedirect
     * @return string
     */
    public function getViewPath($forRedirect = false)
    {
        $model_name_arr = explode('\\', $this->modelClass);
        if ($forRedirect) {
            $ns_prefix = '';
            $ns_prefix_arr = explode('\\', (new \ReflectionObject($this))->getNamespaceName());
            if (end($ns_prefix_arr) != 'Controllers') {
                $ns_prefix = strtolower(end($ns_prefix_arr)) . '/';
            }
            return $ns_prefix . strtolower(end($model_name_arr));
        }
        return 'lgpd::' . strtolower(end($model_name_arr));
    }

}
