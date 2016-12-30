<?php

namespace Admin\Http;

use Numencode\Http\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class BaseController extends Controller
{
    /**
     * Create a new BaseController instance.
     */
    public function __construct()
    {
        view()->share('admin', Auth::guard('admin')->user());
        view()->share('signedIn', (bool) Auth::guard('admin')->check());
    }

    /**
     * Pass data to Javascript
     *
     * @param string $data Data
     *
     * @return void
     */
    protected function js($data)
    {
        JavaScriptFacade::put($data);
    }

    /**
     * Delete the given model entity.
     *
     * @param Model  $model Model to be deleted.
     * @param string $msg   Message for a successful delete.
     * @param string $title Title for a successful delete.
     *
     * @return array
     */
    protected function deleteThe(Model $model, $msg = 'messages.deleted', $title = 'messages.success')
    {
        if ($model->delete()) {
            return [
                'title' => trans("admin::$title"),
                'msg'   => trans("admin::$msg"),
            ];
        }

        return reportError();
    }
}
