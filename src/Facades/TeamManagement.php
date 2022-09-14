<?php

namespace Stats4sd\TeamManagement\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Stats4sd\TeamManagement\TeamManagement
 */
class TeamManagement extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Stats4sd\TeamManagement\TeamManagement::class;
    }
}
