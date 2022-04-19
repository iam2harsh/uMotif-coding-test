<?php

namespace Tests\Unit\Util\Form;

use Tests\TestCase;
use Util\Form\Payload;

class PayloadTest extends TestCase
{
    /** @test **/
    public function can_set_input(): void
    {
        $payload = Payload::make(['name' => 'John']);

        $this->assertEquals(['name' => 'John'], $payload->getInput());
    }

    /** @test **/
    public function can_get_input_by_key(): void
    {
        $payload = Payload::make([
            'first_name' => 'John',
            'last_name' => 'Smith',
        ]);

        $this->assertEquals('Smith', $payload->getInput('last_name'));
    }

    /** @test **/
    public function can_add_to_input(): void
    {
        $payload = Payload::make(['name' => 'John'])->addToInput(['email' => 'john@example.com']);

        $this->assertEquals('john@example.com', $payload->getInput('email'));
    }
}
