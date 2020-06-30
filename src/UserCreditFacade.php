<?php

namespace Messerli90\UserCredit;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Messerli90\UserCredit\Skeleton\SkeletonClass
 */
class UserCreditFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'user-credit';
    }
}
