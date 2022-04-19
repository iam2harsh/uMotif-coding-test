<?php

namespace Util\Component;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Input extends Component
{
    const TYPE = 'input';

    public null|string|array $value = null;

    public ?string $placeholder;

    public bool $required = false;

    public null|array|string $validation = [];

    public array $messages = [];

    public function value(array|string $value): self
    {
        $this->value = $value ?? '';

        return $this;
    }

    public function placeholder(?string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function rules(array|string|null $rules): self
    {
        if ($rules === null) {
            return $this;
        }

        $rules = $this->parseRules($rules);

        $this->validation = $rules;

        $rules->each(function ($rule): void {
            if (is_string($rule) === false) {
                return;
            }
            if (preg_match('/^(required_if|required(?!_))/', $rule) === 0) {
                return;
            }
            $this->required = true;
        });

        return $this;
    }

    public function messages(array $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    public function getValue(): string|array|null
    {
        return $this->value;
    }

    private function parseRules(string|array $rules): Collection
    {
        if (is_string($rules)) {
            $rules = Str::of($rules)->explode('|')->toArray();
        }

        return collect(Arr::wrap($rules));
    }
}
