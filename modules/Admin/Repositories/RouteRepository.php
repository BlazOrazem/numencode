<?php

namespace Admin\Repositories;

use Numencode\Models\System\Url;
use Numencode\Models\System\Language;

class RouteRepository
{
    public function saveUrl($uri = null, $keyword = null, $action, $params = null)
    {
        $url = Url::firstOrNew([
            'action' => $action,
            'params' => json_encode($params),
        ]);

        $url->params = $params;
        $url->uri = $this->buildUri($uri ?: $keyword, $url->id ? $url : null);
        $url->save();

        return $url->id;
    }

    protected function buildUri($keyword = null, Url $url = null)
    {
        $slug = $this->isSluggable($keyword) ? $keyword : str_slug($keyword);

        if (app()->getLocale() != Language::getDefault()->locale) {
            $slug = app()->getLocale() . '/' . ltrim($slug, app()->getLocale() . '/');
        }

        return $this->handleDuplicates($slug, $url);
    }

    protected function handleDuplicates($slug, Url $url = null, $suffix = 0)
    {
        if ($url && $url->uri == $slug) {
            return $slug;
        }

        if ($url && !Url::where('uri', $slug)->where('id', '<>' ,$url->id)->exists()) {
            return $slug;
        }

        if (!Url::where('uri', $slug)->exists()) {
            return $slug;
        }

        $suffix++;

        return $this->handleDuplicates($this->appendSuffix($slug, $suffix), null, $suffix);
    }

    protected function appendSuffix($slug, $suffix)
    {
        if ($suffix == 1) {
            return $slug . '/' . $suffix;
        }

        return ++$slug;
    }

    protected function isSluggable($string)
    {
        return preg_match('/^[a-z0-9\/]+(?:-[a-z0-9\/]+)*$/', $string);
    }
}
