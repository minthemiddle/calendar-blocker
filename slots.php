<?php
require 'vendor/autoload.php';
require 'config.php';

use Carbon\Carbon;
use Chypriote\UniqueNames\Generator;

$generator = new Generator();

$slots = [];
// to save a list of available slots' titles
$titles = (array) [];

while($currentTime <= $end && $day_current <= $day_end) {
    $slotEnd = $currentTime->copy()->addMinutes($slotDuration);
    if ($currentTime->hour * 100 + $currentTime->minute >= $working_hours['break_start'] &&
        $slotEnd->hour * 100 + $slotEnd->minute <= $working_hours['break_end']) {
        $currentTime = Carbon::createFromFormat('Hi', $working_hours['break_end'])->addMinutes($breakDuration);
    } else {
        $title = $generator->generate();

        $slot = [
            'day' => $day_current,
            'start' => $currentTime->format('H:i'),
            'end' => $slotEnd->format('H:i'),
            'title' => $title,
        ];
        
        $slots[] = $slot;
        $titles[] = $title;
        $currentTime = $slotEnd->addMinutes($breakDuration);

        if ($currentTime->hour * 100 + $currentTime->minute >= $working_hours['day_end']) {
            $day_current++;
            $currentTime = $start;
        }
    }
}
