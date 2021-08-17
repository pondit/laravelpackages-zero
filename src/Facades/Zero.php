<?php

namespace Mzr\Zero\Facades;

use Illuminate\Support\Facades\Facade;

class Zero extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zero';
    }
}