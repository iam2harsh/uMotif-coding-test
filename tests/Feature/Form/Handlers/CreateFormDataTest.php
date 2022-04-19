<?php

namespace Tests\Feature\Util\Form\Handlers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Util\Form\Payload;
use Util\Handlers\CreateFormData;

class CreateFormDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test void */
    public function can_create_a_form_data_record(): void
    {
        Carbon::setTestNow('2022-01-01 00:00:00');

        $payload = Payload::make([
            'name' => 'John',
            'dob' => Carbon::createFromFormat('d/m/Y', '01/01/1990'),
            'frequency' => 'monthly',
        ]);

        app(Pipeline::class)
            ->send($payload)
            ->through([new CreateFormData])
            ->thenReturn();

        $this->assertDatabaseHas('form_data', [
            'name' => 'John',
            'dob' => '1990-01-01 00:00:00',
            'frequency' => 'monthly',
            'daily_frequency' => null,
        ]);
    }

    /** @test void */
    public function can_create_a_form_data_record_with_daily_frequency(): void
    {
        Carbon::setTestNow('2022-01-01 00:00:00');

        $payload = Payload::make([
            'name' => 'John',
            'dob' => Carbon::createFromFormat('d/m/Y', '01/01/1990'),
            'frequency' => 'daily',
            'daily_frequency' => '1-2',
        ]);

        app(Pipeline::class)
            ->send($payload)
            ->through([new CreateFormData])
            ->thenReturn();

        $this->assertDatabaseHas('form_data', [
            'name' => 'John',
            'dob' => '1990-01-01 00:00:00',
            'frequency' => 'daily',
            'daily_frequency' => '1-2',
        ]);
    }
}
