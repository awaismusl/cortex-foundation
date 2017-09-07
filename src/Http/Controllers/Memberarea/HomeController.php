<?php

declare(strict_types=1);

namespace Cortex\Foundation\Http\Controllers\Memberarea;

use Cortex\Foundation\Http\Controllers\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Show index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cortex/foundation::memberarea.pages.home');
    }
}
