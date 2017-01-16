<?php

namespace Admin\Http;

use Auth;
use Numencode\Http\Controller;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class BaseController extends Controller
{
    /**
     * Return logged in manager.
     *
     * @return \Numencode\Models\Manager
     */
    public function admin()
    {
        return Auth::guard('admin')->user();
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
