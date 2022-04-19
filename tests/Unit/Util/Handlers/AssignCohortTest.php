<?php

namespace Tests\Unit\Util\Form\Handlers;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Util\Form\Payload;
use Util\Handlers\AssignCohort;

class AssignCohortTest extends TestCase
{
    /** @test void */
    public function under_18_participants_are_not_eligible(): void
    {
        $payload = Payload::make([
            'dob' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
        ]);

        $payload = app(Pipeline::class)
            ->send($payload)
            ->through([new AssignCohort])
            ->thenReturn();

        $this->assertEquals('Participants must be over 18 years of age', $payload->getInput('result'));
    }

    /** @test void */
    public function over_18_participants_with_monthly_migraine_are_assigned_to_cohort_A(): void
    {
        $payload = Payload::make([
            'name' => 'John',
            'dob' => Carbon::createFromFormat('d/m/Y', '01/01/1990'),
            'frequency' => 'monthly',
        ]);

        $payload = app(Pipeline::class)
            ->send($payload)
            ->through([new AssignCohort])
            ->thenReturn();

        $this->assertEquals('Participant John is assigned to Cohort A', $payload->getInput('result'));
    }

    /** @test void */
    public function over_18_participants_with_weekly_migraine_are_assigned_to_cohort_A(): void
    {
        $payload = Payload::make([
            'name' => 'John',
            'dob' => Carbon::createFromFormat('d/m/Y', '01/01/1990'),
            'frequency' => 'weekly',
        ]);

        $payload = app(Pipeline::class)
            ->send($payload)
            ->through([new AssignCohort])
            ->thenReturn();

        $this->assertEquals('Participant John is assigned to Cohort A', $payload->getInput('result'));
    }

    /** @test void */
    public function over_18_participants_with_daily_migraine_are_assigned_to_cohort_B(): void
    {
        $payload = Payload::make([
            'name' => 'John',
            'dob' => Carbon::createFromFormat('d/m/Y', '01/01/1990'),
            'frequency' => 'daily',
        ]);

        $payload = app(Pipeline::class)
            ->send($payload)
            ->through([new AssignCohort])
            ->thenReturn();

        $this->assertEquals('Participant John is assigned to Cohort B', $payload->getInput('result'));
    }
}
