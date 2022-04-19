<?php

namespace Util\Component;

class Button extends Input
{
    const TYPE = 'button';

    public string $method = 'GET';

    public ?string $route = null;

    public function method(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function route(string $route): self
    {
        $this->route = $route;

        return $this;
    }
}
