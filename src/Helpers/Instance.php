<?php

namespace Helldar\Support\Helpers;

use Helldar\Support\Facades\Helpers\Arr;
use Helldar\Support\Facades\Helpers\Is;
use Helldar\Support\Facades\Helpers\Reflection;
use ReflectionClass;

final class Instance
{
    public function of($haystack, $needles): bool
    {
        if (! $this->exists($haystack)) {
            return false;
        }

        $reflection = $this->resolve($haystack);
        $classname  = $this->classname($haystack);

        foreach (Arr::wrap($needles) as $needle) {
            if (! $this->exists($needle)) {
                continue;
            }

            if (
                $haystack instanceof $needle ||
                $classname === $this->classname($needle) ||
                $reflection->isSubclassOf($needle) ||
                $reflection->implementsInterface($needle)
            ) {
                return true;
            }
        }

        return false;
    }

    public function basename($class): string
    {
        $class = $this->classname($class);

        return basename(str_replace('\\', '/', $class));
    }

    public function classname($class = null): ?string
    {
        return Is::object($class) ? get_class($class) : $class;
    }

    public function exists($haystack): bool
    {
        if (Is::object($haystack)) {
            return true;
        }

        if (Is::string($haystack)) {
            return class_exists($haystack) || interface_exists($haystack);
        }

        return false;
    }

    public function call($object, string $method, $default = null)
    {
        if (Is::object($object) && method_exists($object, $method)) {
            return call_user_func([$object, $method]);
        }

        return $default;
    }

    public function callsWhenNotEmpty($object, $methods, $default = null)
    {
        foreach (Arr::wrap($methods) as $method) {
            if ($value = $this->call($object, $method)) {
                return $value;
            }
        }

        return $default;
    }

    public function callOf(array $map, $value, $default = null)
    {
        foreach ($map as $class => $method) {
            if ($this->of($value, $class)) {
                return $value->$method();
            }
        }

        return $default;
    }

    protected function resolve($class): ReflectionClass
    {
        return Reflection::resolve($class);
    }
}