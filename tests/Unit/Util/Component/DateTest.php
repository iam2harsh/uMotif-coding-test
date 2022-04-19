<?php

namespace Tests\Unit\Util\Component;

use Tests\TestCase;
use Util\Component\Date;

class DateTest extends TestCase
{
    /** @test **/
    public function can_make_select(): void
    {
        $select = Date::make('Date of birth');

        $this->assertEquals('Date of birth', $select->label);
    }
}
