<?php

namespace Util\Form;

use Illuminate\Support\Arr;

class FormRegistry
{
    private array $forms = [];

    public function make(string $formName): Form
    {
        if (Arr::has($this->forms, $formName)) {
            return $this->forms[$formName];
        }

        $this->forms[$formName] = new Form($formName);

        return $this->forms[$formName];
    }
}
