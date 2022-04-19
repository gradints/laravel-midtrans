<?php

namespace Gradints\LaravelMidtrans;

use Illuminate\Support\Facades\Facade;

class MidtransFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'midtrans';
    }
}
