<?php

namespace Util\Form\Facades;

use Util\Form\FormRegistry;
use Illuminate\Support\Facades\Facade;

class Form extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FormRegistry::class;
    }
}
