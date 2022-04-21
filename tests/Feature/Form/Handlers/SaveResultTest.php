<?php

namespace Tests\Feature\Util\Form\Handlers;

use App\Models\FormData;
use App\Models\Result;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Util\Form\Payload;
use Util\Handlers\SaveResult;

class SaveResultTest extends TestCase
{
    use RefreshDatabase;

    /** @test void */
    public function can_create_a_result_record(): void
    {
        Carbon::setTestNow('2022-01-01 00:00:00');

        $formData = [
            'name' => 'John',
            'dob' => Carbon::createFromFormat('d/m/Y', '01/01/1990'),
            'frequency' => 'monthly',
        ];
        $formDataModel = FormData::factory($formData)->create();
        $payload = Payload::make($formData)->addToInput([
            'form_data' => $formDataModel,
            'result' => 'test result',
        ]);

        app(Pipeline::class)
            ->send($payload)
            ->through(new SaveResult)
            ->thenReturn();

        $this->assertDatabaseHas('results', [
            'form_data_id' => $formDataModel->id,
            'result' => 'test result',
        ]);
    }

    /** @test */
    public function can_get_form_data_from_result(): void
    {
        $this->assertTrue(Result::factory()->create()->formData->is(FormData::first()));
    }
}
