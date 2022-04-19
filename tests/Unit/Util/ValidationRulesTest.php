<?php

namespace Tests\Unit\Util;

use Tests\TestCase;
use Util\Component\Input;
use Util\ValidationRules;

class ValidationRulesTest extends TestCase
{
    /** @test **/
    public function can_set_validation_rules(): void
    {
        $fields = [
            Input::make('Name')->rules(['required']),
        ];

        $actual = ValidationRules::for($fields)->get();

        $expected = [
            'name' => ['required'],
        ];

        $this->assertEquals($expected, $actual);
    }
}
