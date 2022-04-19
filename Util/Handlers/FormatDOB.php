<?php

namespace Util\Handlers;

use Closure;
use Illuminate\Support\Carbon;
use Util\Form\Payload;

class FormatDOB
{
    public function __invoke(Payload $payload, Closure $next)
    {
        $payload->addToInput([
            'dob' => Carbon::createFromFormat('d/m/Y', $payload->getInput('dob')),
        ]);

        return $next($payload);
    }
}
