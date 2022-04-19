<?php

namespace Util\Form;

use App\Exceptions\NoSaveHandlers;
use Util\ValidationMessages;
use Util\ValidationRules;
use Closure;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class Form
{
    public array $blocks = [];

    private array $saveHandlers = [];

    public array $actions = [];

    public function __construct(public string $name) {}

    public function addFields(callable $fields): self
    {
        $this->blocks[] = $fields;

        return $this;
    }

    public function addAction(callable $action): self
    {
        $this->actions[] = $action;

        return $this;
    }

    public function addHandlers(array $saveHandlers): self
    {
        foreach ($saveHandlers as $saveHandler) {
            $this->saveHandlers[] = $saveHandler;
        }

        return $this;
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(array $input): self
    {
        $this->resolve();

        Validator::make(
            $input,
            ValidationRules::for($this->blocks)->get(),
            ValidationMessages::for($this->blocks)->get()
        )->validate();

        return $this;
    }

    public function handle(array $input): mixed
    {
        throw_if($this->saveHandlers === [], NoSaveHandlers::class);

        $this->invokeSaveHandlers();

        $payload = Payload::make($input);

        return app(Pipeline::class)
            ->send($payload)
            ->through($this->saveHandlers)
            ->thenReturn();
    }

    private function invokeSaveHandlers(): void
    {
        $this->saveHandlers = array_map(function ($handler) {
            if (is_string($handler)) {
                return new $handler();
            }

            return $handler;
        }, $this->saveHandlers);
    }

    public function render(): array
    {
        $this->resolve();

        return [
            'actions' => $this->actions,
            'content' => $this->blocks,
            'label' => $this->name,
        ];
    }

    private function resolve(): void
    {
        $this->resolveActions();
        $this->resolveBlocks();
    }

    private function resolveActions(): void
    {
        $actions = array_map(function ($action) {
            if ($action instanceof Closure === false) {
                return $action;
            }

            return app()->call($action);
        }, $this->actions);

        $this->actions = array_values(array_filter(Arr::flatten($actions)));
    }

    private function resolveBlocks(): void
    {
        $this->blocks = collect($this->blocks)
            ->map(function ($block) {
                if ($block instanceof Closure) {
                    return app()->call($block);
                }

                return $block;
            })
            ->flatten()
            ->toArray();
    }
}
