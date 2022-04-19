<?php

namespace Util\Component;

use Illuminate\Support\Str;

abstract class Component
{
    const TYPE = 'component';

    public string $componentType;

    public ?string $name;

    public array $logic = [];

    public function __construct(public ?string $label = null)
    {
        $this->name = $label !== null ? Str::slug($label, '_') : null;
        $this->componentType = $this::TYPE;
    }

    public static function make(?string $label = null): self
    {
        return new static($label);
    }

    public function name(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function showIf(string $field, mixed $value): self
    {
        $this->logic['showIf'] = [
            'field' => $field,
            'value' => $value,
        ];

        return $this;
    }
}
