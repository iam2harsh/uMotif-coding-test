<?php

namespace Tests\Unit\Util;

use Tests\TestCase;
use Util\Component\Input;
use Util\ValidationMessages;

class ValidationMessagesTest extends TestCase
{
    /** @test **/
    public function can_set_validation_messages(): void
    {
        $fields = [
            Input::make('Name')->messages([
                'required' => 'The name is required',
            ]),
        ];

        $actual = ValidationMessages::for($fields)->get();

        $expected = [
            'name.required' => 'The name is required',
        ];

        $this->assertEquals($expected, $actual);
    }
}
