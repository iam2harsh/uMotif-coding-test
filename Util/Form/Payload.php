<?php

namespace Util\Form;

use Illuminate\Support\Arr;

class Payload
{
    public function __construct(private array $input) {}

    public static function make(array $input = []): self
    {
        return new self($input);
    }

    public function addToInput(array $input): self
    {
        $this->input = array_merge($this->input, $input);

        return $this;
    }

    public function getInput(?string $key = null): mixed
    {
        if ($key) {
            return Arr::get($this->input, $key);
        }

        return $this->input;
    }
}
