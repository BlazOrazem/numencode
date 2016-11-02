<?php

namespace Numencode\Models;

use Laraplus\Data\Translatable;
use Numencode\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Numencode\Models\Traits\HiddenFilter;

class Content extends Model
{
    use Translatable, Sortable, HiddenFilter;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['page_id', 'plugin_id', 'plugin_params', 'sort_order', 'is_hidden', 'title', 'lead', 'body'];

	/**
	 * Cast attributes to other types.
	 *
	 * @var array
	 */
	protected $casts = ['plugin_params' => 'object'];

    /**
     * Disable timestamps for this table.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Content belongs to plugin.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plugin()
    {
        return $this->belongsTo(Plugin::class);
    }

    /**
     * Render plugin for view.
     *
     * @return mixed|null
     */
    public function renderPlugin()
    {
        if (!$this->plugin) {
            return null;
        }

        $action = explode('@', $this->plugin->action);

        return app()->call(
            [app('Cms\Http\\' . $action[0]), isset($action[1]) ? $action[1] : 'index'], ['params' => $this->plugin_params]
        );
    }
}
