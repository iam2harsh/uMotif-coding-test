<?php

use Util\Component\Button;
use Util\Component\Date;
use Util\Component\Input;
use Util\Component\Option;
use Util\Component\Select;
use Util\Form\Facades\Form;
use Util\Handlers\AssignCohort;
use Util\Handlers\CreateFormData;
use Util\Handlers\FormatDOB;
use Util\Handlers\SaveResult;

Form::make('clinical-trial')
    ->addHandlers([
        FormatDOB::class,
        CreateFormData::class,
        AssignCohort::class,
        SaveResult::class
    ])
    ->addFields(function () {
        return [
            Input::make('name')
                ->label('First Name')
                ->rules('required')
                ->messages([
                    'required' => 'Please enter your first name',
                ])
                ->placeholder('John'),
            Date::make('dob')
                ->label('Date of birth')
                ->rules('required')
                ->messages([
                    'required' => 'Please enter your date of birth',
                ])
                ->placeholder('DD/MM/YYYY'),
            Select::make('frequency')
                ->label('The frequency with which you experience migraine headaches')
                ->options([
                    Option::make('Monthly'),
                    Option::make('Weekly'),
                    Option::make('Daily'),
                ])
                ->rules('required')
                ->messages([
                    'required' => 'Please enter the frequency with which you experience migraine headaches',
                ]),
            Select::make('daily_frequency')
                ->label('The daily frequency with which you experience migraine headaches')
                ->options([
                    Option::make('1-2'),
                    Option::make('3-4'),
                    Option::make('5+'),
                ])
                ->showIf('frequency', 'daily'),
        ];
    })
    ->addAction( function() {
        return Button::make('Submit')
            ->method('POST')
            ->route(route('form.save'));
    });
