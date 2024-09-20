<?php

namespace Spatie\PestPluginTestTime;

function testTime(): TestTime
{
    return new TestTime;
}

expect()->extend('toBeCarbon', function (string $expected, ?string $format = null) {
    if ($format === null) {
        $format = str_contains($expected, ':')
            ? 'Y-m-d H:i:s'
            : 'Y-m-d';
    }

    expect($this->value?->format($format))->toBe($expected);
});
