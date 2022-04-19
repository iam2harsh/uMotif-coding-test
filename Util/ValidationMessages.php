<?php

namespace Util;

use Illuminate\Support\Collection;
use Util\Component\Component;
use Util\Component\Input;

class ValidationMessages
{
    public Collection $messages;

    public function __construct(array $fields)
    {
        $this->messages = collect($fields)
            ->flatten()
            ->filter(function (Component $component) {
                return $component instanceof Input;
            })
            ->mapWithKeys(function (Input $input) {
                return collect($input->messages)
                    ->mapWithKeys(function ($value, $key) use ($input) {
                        return ["{$input->name}.{$key}" => $value];
                    })
                    ->toArray();
            });
    }

    public static function for(array $fields): self
    {
        return new self($fields);
    }

    public function get(): array
    {
        return $this->messages->toArray();
    }
}
