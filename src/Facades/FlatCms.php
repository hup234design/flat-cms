<?php

namespace Hup234design\FlatCms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hup234design\FlatCms\FlatCms
 */
class FlatCms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Hup234design\FlatCms\FlatCms::class;
    }
}
