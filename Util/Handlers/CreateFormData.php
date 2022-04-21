<?php

namespace Util\Handlers;

use App\Models\FormData;
use Closure;
use Util\Form\Payload;

class CreateFormData
{
    public function __invoke(Payload $payload, Closure $next)
    {
        $form_data = FormData::create($payload->getInput());

        $payload->addToInput(['form_data' => $form_data]);

        return $next($payload);
    }
}
