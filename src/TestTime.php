<?php

namespace Spatie\PestPluginTestTime;

use Carbon\Carbon;
use Spatie\TestTime\TestTime as BaseTestTime;

/** @mixin BaseTestTime|\Carbon\Carbon */
class TestTime
{
    public function freeze(string $format = null, $time = null): Carbon
    {
        return BaseTestTime::freeze($format, $time);
    }

    public function __call($name, $arguments)
    {
        return BaseTestTime::$name(...$arguments);
    }
}
