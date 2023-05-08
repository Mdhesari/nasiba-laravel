<?php

namespace Mdhesari\Nasiba;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mdhesari\Nasiba\Skeleton\SkeletonClass
 */
class NasibaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'nasiba';
    }
}
