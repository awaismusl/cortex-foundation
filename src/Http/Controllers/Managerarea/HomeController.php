<?php

declare(strict_types=1);

namespace Cortex\Foundation\Http\Controllers\Managerarea;

use Cortex\Foundation\Http\Controllers\AuthorizedController;

class HomeController extends AuthorizedController
{
    /**
     * {@inheritdoc}
     */
    protected $resource = 'managerarea';

    /**
     * {@inheritdoc}
     */
    protected $resourceAbilityMap = [
        'index' => 'access',
    ];

    /**
     * Show managerarea index.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('cortex/foundation::managerarea.pages.index');
    }
}
