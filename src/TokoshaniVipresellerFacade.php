<?php

namespace Jstalinko\TokoshaniVipreseller;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jstalinko\TokoshaniVipreseller\Skeleton\SkeletonClass
 */
class TokoshaniVipresellerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tokoshani-vipreseller';
    }
}
