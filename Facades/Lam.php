<?php

namespace Modules\LAM\Facades;

class Lam extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return "lam";//\Modules\LAM\Classes\Lam::class;
    }
}
