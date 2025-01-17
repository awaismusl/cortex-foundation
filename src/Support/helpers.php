<?php

declare(strict_types=1);

use Illuminate\Support\Str;

if (! function_exists('extract_title')) {
    /**
     * Extract page title from breadcrumbs.
     *
     * @param mixed $breadcrumbs
     *
     * @return string
     */
    function extract_title($breadcrumbs, string $separator = ' » ')
    {
        return Str::afterLast(preg_replace('/[\n\r\s]+/', ' ', strip_tags(Str::replaceLast($separator, '', str_replace('</li>', $separator, (string) $breadcrumbs)))), $separator)." {$separator} ".config('app.name');
    }
}

if (! function_exists('route_prefix')) {
    /**
     * Return route prefix.
     *
     * @param mixed $accessarea
     *
     * @return string
     */
    function route_prefix($accessarea)
    {
        $prefix = app('accessareas')->firstWhere('slug', $accessarea)?->prefix;

        return config('cortex.foundation.route.locale_prefix') ? "{locale}/{$prefix}" : $prefix;
    }
}

if (! function_exists('intend')) {
    /**
     * Return redirect response.
     *
     * @param array    $arguments
     * @param int|null $status
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    function intend(array $arguments, int $status = null)
    {
        if (request()->expectsJson()) {
            $messages = collect($arguments['with'] ?? []);
            $errors = collect($arguments['withErrors'] ?? []);

            return $errors->isNotEmpty() ?
                response()->json([$errors->flatten()->first() ?: 'Error'], $status ?: 422) :
                response()->json([$messages->flatten()->first() ?: 'OK'], $status ?: 200);
        }

        $redirect = redirect(Arr::pull($arguments, 'url'), in_array($status, [201, 301, 302, 303, 307, 308]) ? $status : 302);

        foreach ($arguments as $key => $value) {
            $redirect = in_array($key, ['home', 'back']) ? $redirect->{$key}() : $redirect->{$key}($value);
        }

        return $redirect;
    }
}
