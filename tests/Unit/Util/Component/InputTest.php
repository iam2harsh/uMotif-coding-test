<?php

namespace Tests\Unit\Util\Component;

use Tests\TestCase;
use Util\Component\Input;

class InputTest extends TestCase
{
    /** @test **/
    public function can_make_input(): void
    {
        $input = Input::make('Name');

        $this->assertEquals('Name', $input->label);
    }

    /** @test */
    public function can_make_without_giving_value(): void
    {
        $input = Input::make('Frequency type');

        $this->assertEquals('Frequency type', $input->label);
        $this->assertEquals(null, $input->value);
    }

    /** @test */
    public function can_make_with_giving_value(): void
    {
        $input = Input::make('Frequency')
            ->value('test');

        $this->assertEquals('Frequency', $input->label);
        $this->assertEquals('test', $input->value);
    }
}
