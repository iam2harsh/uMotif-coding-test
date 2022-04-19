<?php

namespace Util\Component;

class Select extends Input
{
    const TYPE = 'select';

    public array $options = [];

    public function options(?array $options): self
    {
        $this->options = $this->convertToArray($options);

        return $this;
    }

    private function convertToArray(array $options): array
    {
        return collect($options)->map(function ($options): array {
            if (is_array($options)) {
                return $options;
            }

            return $options->toArray();
        })
            ->toArray();
    }
}
