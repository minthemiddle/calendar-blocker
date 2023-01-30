<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

$working_hours = [
    'day_start' => 1000,
    'break_start' => 1230,
    'break_end' => 1330,
    'day_end' => 1730,
];

$slotDuration = 25;
$breakDuration = 5;

$start = Carbon::createFromFormat('Hi', $working_hours['day_start']);
$end = Carbon::createFromFormat('Hi', $working_hours['day_end']);

$currentTime = $start;
$day_start = 1;
$day_end = 5;
$day_current = 1;
$slots = [];

while($currentTime <= $end && $day_current <= $day_end) {
    $slotEnd = $currentTime->copy()->addMinutes($slotDuration);
    if ($currentTime->hour * 100 + $currentTime->minute >= $working_hours['break_start'] &&
        $slotEnd->hour * 100 + $slotEnd->minute <= $working_hours['break_end']) {
        $currentTime = Carbon::createFromFormat('Hi', $working_hours['break_end'])->addMinutes($breakDuration);
    } else {
        $slot = [
            'day' => $day_current,
            'start' => $currentTime->format('H:i'),
            'end' => $slotEnd->format('H:i'),
        ];
        
        $slots[] = $slot;
        $currentTime = $slotEnd->addMinutes($breakDuration);

        if ($currentTime->hour * 100 + $currentTime->minute >= $working_hours['day_end']) {
            $day_current++;
            $currentTime = $start;
        }
    }
}

print_r($slots);

