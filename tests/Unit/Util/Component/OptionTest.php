<?php

namespace Tests\Unit\Util\Component;

use Tests\TestCase;
use Util\Component\Option;

class OptionTest extends TestCase
{
    /** @test **/
    public function can_make_option(): void
    {
        $option = Option::make('Selection A');

        $this->assertEquals('Selection A', $option->label);
    }

    /** @test */
    public function can_make_without_giving_value(): void
    {
        $option = Option::make('Selection A');

        $this->assertEquals('Selection A', $option->label);
        $this->assertEquals('selection_a', $option->value);
    }

    /** @test */
    public function can_make_with_giving_value(): void
    {
        $option = Option::make('Selection A')->value('test');

        $this->assertEquals('Selection A', $option->label);
        $this->assertEquals('test', $option->value);
    }

    /** @test */
    public function value_can_be_an_int(): void
    {
        $option = Option::make('Selection A')->value(1);

        $this->assertEquals('Selection A', $option->label);
        $this->assertEquals(1, $option->value);
    }
}
