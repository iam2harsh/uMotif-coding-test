<?php

namespace Tests\Unit\Util\Form\Handlers;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Util\Form\Payload;
use Util\Handlers\FormatDOB;

class FormatDOBTest extends TestCase
{
    /** @test void */
    public function converts_dob_into_a_carbon_object(): void
    {
        $payload = Payload::make([
            'dob' => '01/01/1990',
        ]);

        $payload = app(Pipeline::class)
            ->send($payload)
            ->through([new FormatDOB])
            ->thenReturn();

        $this->assertInstanceOf(Carbon::class, $payload->getInput('dob'));
        $this->assertEquals('01/01/1990', $payload->getInput('dob')->format('d/m/Y'));
    }
}
