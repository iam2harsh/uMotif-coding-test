<?php

namespace Util\Handlers;

use App\Models\FormData;
use Closure;
use Util\Form\Payload;

class CreateFormData
{
    public function __invoke(Payload $payload, Closure $next)
    {
        FormData::create($payload->getInput());

        return $next($payload);
    }
}
