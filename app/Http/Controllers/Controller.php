<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;

    /**
     * Set the success redirect message.
     *
     * @param string  $model
     * @param string  $action
     * @return string
     */
    public function successMessage($model, $action)
    {
        return __('The :model has been successfully :action.', ['model' => $model, 'action' => $action]);
    }

    /**
     * Set the fail redirect message.
     *
     * @param string  $model
     * @param string  $action
     * @return string
     */
    public function failMessage($model, $action)
    {
        return __('The :model could not be :action. Please, try again!', ['model' => $model, 'action' => $action]);
    }
}
