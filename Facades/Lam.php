<?php

namespace Modules\LAM\Facades;

class Lam extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Modules\LAM\Classes\BaseLam::class;
    }
}
