<?php

/*
 * NOTICE OF LICENSE
 *
 * Part of the Cortex Foundation Module.
 *
 * This source file is subject to The MIT License (MIT)
 * that is bundled with this package in the LICENSE file.
 *
 * Package: Cortex Foundation Module
 * License: The MIT License (MIT)
 * Link:    https://rinvex.com
 */

declare(strict_types=1);

namespace Cortex\Foundation\Http\Middleware;

use Closure;

class TrailingSlashEnforce
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->ajax()) {
            $requestUri = $request->getRequestUri();
            $queryString = $request->getQueryString();
            $untrimmedPath = trim($request->getPathInfo(), '/').'/';

            if ($request->method() == 'GET' && strrchr($requestUri, '.') === false && $this->checkQueryString($requestUri, $queryString)) {
                return redirect()->to($untrimmedPath.(! empty($queryString) ? '?'.$queryString : ''), 301);
            }
        }

        return $next($request);
    }

    /**
     * @param $requestUri
     * @param $queryString
     *
     * @return bool
     */
    protected function checkQueryString($requestUri, $queryString)
    {
        return (! $queryString && ! ends_with($requestUri, '/')) || ($queryString && ! ends_with(strstr($requestUri, '?', true), '/'));
    }
}
