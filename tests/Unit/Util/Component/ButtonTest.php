<?php

namespace Tests\Unit\Util\Component;

use Tests\TestCase;
use Util\Component\Button;

class ButtonTest extends TestCase
{
    /** @test **/
    public function can_make_button(): void
    {
        $button = Button::make('Submit');

        $this->assertEquals('Submit', $button->label);
    }

    /** @test **/
    public function can_add_method_to_button(): void
    {
        $button = Button::make('Submit')->method('POST');

        $this->assertEquals('POST', $button->method);
    }

    /** @test **/
    public function can_add_route_to_button(): void
    {
        $button = Button::make('Submit')->route('form.index');

        $this->assertEquals('form.index', $button->route);
    }
}
