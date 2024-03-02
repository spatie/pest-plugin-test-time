<?php

use Carbon\Carbon;

use function Spatie\PestPluginTestTime\testTime;

it('can freeze the time the current time', function () {
    testTime()->freeze();

    $timeBeforeFreezing = (new Carbon())->timestamp;

    sleep(1);

    $timeAfterFreezing = (new Carbon())->timestamp;

    expect($timeAfterFreezing)->toEqual($timeBeforeFreezing);
});

it('can freeze the time', function () {
    $time = '2021-01-01 01:23:45';
    $format = 'Y-m-d H:i:s';

    testTime()->freeze($time, $format);

    $actualTime = (new Carbon())->format($format);

    expect($actualTime)->toBe($time);
});

it('can change the time', function () {
    $format = 'Y-m-d H:i:s';

    testTime()->freeze('2021-01-01 01:23:45', $format);

    testTime()->addHour()->subMinute();
    $actualTime = (new Carbon())->format($format);
    expect($actualTime)->toBe('2021-01-01 02:22:45');

    testTime()->addMinute();
    $actualTime = (new Carbon())->format($format);
    expect($actualTime)->toBe('2021-01-01 02:23:45');
});

it('can make a carbon expectation', function () {
    $carbon = Carbon::createFromFormat('Y-m-d H:i:s', '2022-05-31 01:02:03');

    expect($carbon)->toBeCarbon('2022-05-31');
    expect($carbon)->toBeCarbon('2022-05-31 01:02:03');
    expect($carbon)->toBeCarbon('2022', 'Y');

    expect($carbon)->not()->toBeCarbon('2022-06-31');
    expect($carbon)->not()->toBeCarbon('2022-05-31 03:03:03');
    expect($carbon)->not()->toBeCarbon('2023', 'Y');

    expect(null)->not()->toBeCarbon('2022-06-31');
});
