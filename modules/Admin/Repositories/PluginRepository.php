<?php

namespace Admin\Repositories;

use Numencode\Models\Plugin;

class PluginRepository
{
    /**
     * Create form for plugin params.
     *
     * @param Plugin      $plugin Plugin
     * @param object|null $data   Data
     * @return \Illuminate\View\View
     */
    public function renderPluginForm(Plugin $plugin, $data = null)
    {
        $elements = collect($plugin->params)->map(function ($item) {
            if (in_array($item->type, ["select", "radio", "checkbox"])) {
                $item->options = $this->handleSelectOptions($item->options);
            }

            return $item;
        });

        return view('admin::plugins.form', [
            'elements' => $elements,
            'data'     => $data,
        ]);
    }

    /**
     * Handle options for select box based on given data.
     *
     * @param object $data Data for building the list of options
     *
     * @return array
     */
    protected function handleSelectOptions($data)
    {
        if (strpos($data, '@') !== false){
            $namespace = isset($data->namespace) ? $data->namespace : config('numencode.models_namespace');
            $data = explode('@', $data);

            return app()->call([$namespace . $data[0], $data[1]]);
        }

        $data = explode(',', $data);

        return array_combine($data, $data);
    }
}
