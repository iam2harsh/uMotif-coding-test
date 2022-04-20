<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Util\Form\Facades\Form;

class FormController extends Controller
{
    public function index(): View
    {
        return view('index')->with([
            'form' => Form::make('clinical-trial')->render(),
            'csrf' => csrf_token(),
        ]);
    }

    public function store(Request $request): View
    {
        $payload = Form::make('clinical-trial')
            ->validate($request->all())
            ->handle($request->all());

        return view('result')->with([
            'result' => $payload->getInput('result'),
        ]);
    }
}
