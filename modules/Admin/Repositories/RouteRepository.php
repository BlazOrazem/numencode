<?php

namespace Admin\Repositories;

use Numencode\Models\System\Url;
use Numencode\Models\System\Language;

class RouteRepository
{
    /**
     * Create or update an URL.
     *
     * @param null|string $uri     Custom URI string.
     * @param null|string $keyword Keyword for creating a slug.
     * @param string      $action  Controller and action.
     * @param null|array  $params  Parameters.
     *
     * @return int
     */
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

    /**
     * URL builder.
     *
     * @param null|string $keyword Keyword for creating a slug.
     * @param Url         $url     Url object.
     *
     * @return string
     */
    protected function buildUri($keyword = null, Url $url = null)
    {
        $slug = $this->isSluggable($keyword) ? $keyword : str_slug($keyword);

        if (!$keyword || app()->getLocale() != Language::getDefault()->locale) {
            $slug = app()->getLocale() . '/' . ltrim($slug, app()->getLocale() . '/');
        }

        return $this->handleDuplicates($slug, $url);
    }

    /**
     * Handle URL duplicates.
     *
     * @param string $slug   Slug for URI.
     * @param Url    $url    Url object.
     * @param int    $suffix Suffix number.
     *
     * @return string
     */
    protected function handleDuplicates($slug, Url $url = null, $suffix = 0)
    {
        if ($url && $url->uri == $slug) {
            return $slug;
        }

        if ($url && !Url::where('uri', $slug)->where('id', '<>' ,$url->id)->exists()) {
            return $slug;
        }

        if (!Url::where('uri', $slug)->exists() && substr($slug, -1) != '/') {
            return $slug;
        }

        $suffix++;

        return $this->handleDuplicates($this->appendSuffix($slug, $suffix), null, $suffix);
    }

    /**
     * Append suffix integer to a slug.
     *
     * @param string $slug   Slug for URI.
     * @param int    $suffix Suffix number.
     *
     * @return string
     */
    protected function appendSuffix($slug, $suffix)
    {
        if ($suffix == 1) {
            if (substr($slug, -1) == '/') {
                $slug = rtrim($slug, '/');
            }

            return $slug . '/' . $suffix;
        }

        return ++$slug;
    }

    /**
     * Check if the given string is sluggable.
     *
     * @param string $string String
     *
     * @return bool
     */
    protected function isSluggable($string)
    {
        return preg_match('/^[a-z0-9\/]+(?:-[a-z0-9\/]+)*$/', $string);
    }
}
