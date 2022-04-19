<?php

namespace Util\Component;

use Illuminate\Support\Str;

class Option
{
    public string $label;

    public mixed $value;

    public function __construct(string $label, string $separator = '_')
    {
        $this->label = $label;
        $this->value = Str::slug($label, $separator);
    }

    public static function make(string $label, string $separator = '_'): self
    {
        return new static($label, $separator);
    }

    public function value(mixed $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'value' => $this->value,
        ];
    }
}
