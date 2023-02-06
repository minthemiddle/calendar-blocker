<?php
require 'vendor/autoload.php';
require 'config.php';

use Carbon\Carbon;


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
