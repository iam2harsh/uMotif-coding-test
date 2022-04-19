<?php

namespace Util;

use Illuminate\Support\Collection;
use Util\Component\Component;
use Util\Component\Input;

class ValidationRules
{
    public Collection $rules;

    public function __construct(array $fields)
    {
        $this->rules = collect($fields)
            ->flatten()
            ->filter(function (Component $component) {
                return $component instanceof Input;
            })
            ->filter(function (Input $input) {
                return collect($input->validation)->isNotEmpty();
            })
            ->reduce(function (Collection $rules, Input $input) {
                $validation = json_decode($input->validation);

                return tap($rules)
                    ->put(
                        $input->name,
                        $validation
                    );
            }, collect())
            ->filter();
    }

    public static function for(array $fields): self
    {
        return new self($fields);
    }

    public function get(): array
    {
        return $this->rules->toArray();
    }
}
