<?php

namespace Tests\Unit\Util\Component;

use Tests\TestCase;
use Util\Component\Option;
use Util\Component\Select;

class SelectTest extends TestCase
{
    /** @test **/
    public function can_make_select(): void
    {
        $select = Select::make('Frequency');

        $this->assertEquals('Frequency', $select->label);
    }

    /** @test */
    public function can_set_options(): void
    {
        $select = Select::make('Frequency')
            ->options([
                Option::make('Daily'),
                Option::make('Weekly',),
                Option::make('Monthly'),
                Option::make('Yearly'),
            ]);

        $expected = [
            ['label' => 'Daily', 'value' => 'daily'],
            ['label' => 'Weekly', 'value' => 'weekly'],
            ['label' => 'Monthly', 'value' => 'monthly'],
            ['label' => 'Yearly', 'value' => 'yearly'],
        ];

        $this->assertEquals($expected, $select->options);
    }
}
