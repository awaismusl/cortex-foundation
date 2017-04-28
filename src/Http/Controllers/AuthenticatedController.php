<?php

declare(strict_types=1);

namespace Cortex\Foundation\Http\Controllers;

class AuthenticatedController extends AbstractController
{
    /**
     * Create a new manage persistence controller instance.
     */
    public function __construct()
    {
        $this->middleware($this->getAuthMiddleware(), ['except' => $this->middlewareWhitelist]);
    }
}
