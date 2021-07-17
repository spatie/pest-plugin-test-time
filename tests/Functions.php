<?php

use Carbon\Carbon;
use function Spatie\PestPluginTestTime\testTime;

it('can freeze the time', function () {
    $format = 'Y-m-d H:i:s';
    $time = '2021-01-01 01:23:45';

    testTime()->add;

    $actualTime = (new Carbon())->format($format);

    expect($actualTime)->toBe($time);
});

it('can change the time', function () {
    $format = 'Y-m-d H:i:s';

    testTime()->freeze($format, '2021-01-01 01:23:45');

    testTime()->addHour()->subMinute();
    $actualTime = (new Carbon())->format($format);
    expect($actualTime)->toBe('2021-01-01 02:22:45');

    testTime()->addMinute();
    $actualTime = (new Carbon())->format($format);
    expect($actualTime)->toBe('2021-01-01 02:23:45');
});
