<?php

namespace Tests\Unit\Util\Form;

use Tests\TestCase;
use Util\Component\Button;
use Util\Component\Input;
use Util\Form\Facades\Form;

class FormTest extends TestCase
{
    /** @test void */
    public function can_make_instance(): void
    {
        $form = Form::make('test.create');

        $this->assertInstanceOf(\Util\Form\Form::class, $form);
    }

    /** @test **/
    public function makes_multiple_instances(): void
    {
        $formA = Form::make('test.create');
        $formB = Form::make('test.edit');

        $this->assertNotSame($formA, $formB);
        $this->assertEquals('test.create', $formA->name);
        $this->assertEquals('test.edit', $formB->name);
    }

    /** @test **/
    public function can_add_array_of_fields(): void
    {
        $form = Form::make('test.create')
            ->addFields(function () {
                return [
                    Input::make('Name'),
                ];
            });

        $this->assertIsArray($form->blocks);
        $this->assertCount(1, $form->blocks);
    }

    /** @test **/
    public function can_call_add_fields_multiple_times(): void
    {
        $form = Form::make('test.create')
            ->addFields(function () {
                return [
                    Input::make('Name'),
                ];
            })
            ->addFields(function () {
                return [
                    Input::make('Date of birth'),
                ];
            });

        $this->assertIsArray($form->blocks);
        $this->assertCount(2, $form->blocks);
    }

    /** @test **/
    public function can_add_action(): void
    {
        $form = Form::make('test.create')
            ->addAction(function () {
                return Button::make('Test Button');
            })
            ->render();

        $this->assertTrue(is_array($form['actions']));
        $this->assertInstanceOf(Button::class, $form['actions'][0]);
    }
}
