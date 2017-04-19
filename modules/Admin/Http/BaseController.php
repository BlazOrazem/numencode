<?php

namespace Admin\Http;

use Numencode\Http\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

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

        return report_error();
    }
}
