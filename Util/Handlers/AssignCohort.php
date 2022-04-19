<?php

namespace Util\Handlers;

use Closure;
use Util\Form\Payload;

class AssignCohort
{
    public function __invoke(Payload $payload, Closure $next)
    {
        $name = $payload->getInput('name');

        if ($payload->getInput('dob')->diffInYears() < 18) {
            $payload->addToInput([
                'result' => 'Participants must be over 18 years of age',
            ]);

            return $next($payload);
        }

        if ($payload->getInput('frequency') !== 'daily') {
            $payload->addToInput([
                'result' => "Participant {$name} is assigned to Cohort A",
            ]);

            return $next($payload);
        }

        $payload->addToInput([
            'result' => "Participant {$name} is assigned to Cohort B"
        ]);

        return $next($payload);
    }
}
