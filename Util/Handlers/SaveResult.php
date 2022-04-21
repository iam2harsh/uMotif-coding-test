<?php

namespace Util\Handlers;

use App\Models\Result;
use Closure;
use Util\Form\Payload;

class SaveResult
{
    public function __invoke(Payload $payload, Closure $next)
    {
        Result::create([
            'form_data_id' => $payload->getInput('form_data')->id,
            'result' => $payload->getInput('result'),
        ]);

        return $next($payload);
    }
}
