<?php
require 'vendor/autoload.php';
require 'config.php';

use Carbon\Carbon;
use Chypriote\UniqueNames\Generator;

$generator = new Generator();

// to save a list of available slots
$slots = [];
// to save a list of available slots' titles
$titles = [];

$currentTime = Carbon::createFromFormat('Hi', $working_hours['day_start']);
$end = Carbon::createFromFormat('Hi', $working_hours['day_end']);

$day_current = 0; // Initialize day_current variable

while ($currentTime <= $end && $day_current < $days_to_generate) { // Use "<" instead of "<="
    for ($i = 0; $i < count($priorities); $i++) {
        $slotEnd = $currentTime->copy()->addMinutes($timeSlotDuration);

        if (
            $currentTime->hour * 100 + $currentTime->minute >= $working_hours['break_start'] &&
            $slotEnd->hour * 100 + $slotEnd->minute <= $working_hours['break_end']
        ) {
            $currentTime = Carbon::createFromFormat('Hi', $working_hours['break_end'])->addMinutes($breakInterval);
        } else {
            $title = $generator->generate();

            $slot = [
                'day' => $day_current,
                'start_hour' => $currentTime->format('H'),
                'start_minutes' => $currentTime->format('i'),
                'end_hour' => $slotEnd->format('H'),
                'end_minutes' => $slotEnd->format('i'),
                'title' => $title,
            ];

            $slots[] = $slot;
            $titles[] = $title;

            $currentTime = $currentTime->addMinutes($timeSlotDuration);

            if ($currentTime->hour * 100 + $currentTime->minute >= $working_hours['day_end']) {
                $day_current++;
                $currentTime = Carbon::createFromFormat('Hi', $working_hours['day_start']);
            }
        }
    }
}
