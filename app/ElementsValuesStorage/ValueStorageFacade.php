<?php

namespace App\ElementsValuesStorage;

class ValueStorageFacade
{
    protected static function getFacadeAccessor()
    {
        return 'valuestorage';
    }
}