<?php
require 'vendor/autoload.php';

use Carbon\Carbon;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Enums\Classification;

require 'slots.php';

function generate_slots_priorities($priorities, $total_slots) {
    $slots_priorities = [];

    foreach ($priorities as $priority) {
        $count = round($priority['weight'] / 100 * $total_slots);
        for ($i = 0; $i < $count; $i++) {
            $slots_priorities[] = $priority['title'];
        }
    }
    return $slots_priorities;
}

$slots_priorities_and_titles = generate_slots_priorities($priorities, count($slots));
shuffle($slots_priorities_and_titles);

foreach ($slots as $slot) {
    $priority = array_shift($slots_priorities_and_titles);
    $startDateTime = Carbon::today(date_default_timezone_get())
        ->addDays($slot['day'])
        ->setTime($slot['start_hour'], $slot['start_minutes']);
    $endDateTime = Carbon::today(date_default_timezone_get())
        ->addDays($slot['day'])
        ->setTime($slot['end_hour'], $slot['end_minutes']);
    
    // Skip if this slot falls during break time
    $slotStart = $startDateTime->hour * 100 + $startDateTime->minute;
    $slotEnd = $endDateTime->hour * 100 + $endDateTime->minute;
    if ($slotStart >= $working_hours['break_start'] && $slotEnd <= $working_hours['break_end']) {
        continue;
    }
    
    $events[] = Event::create()
        ->name('🚧 ' . $priority)
        ->description('Priority: ' . $priority . ', ID: ' . $slot['title'])
        ->startsAt($startDateTime)
        ->endsAt($endDateTime)
        ->classification(Classification::private());
}

// Create iCalendar data
$calendar = Calendar::create('Blocker')
    ->event($events)
    ->timezone(date_default_timezone_get())
    ->withoutTimezone()
    ->get();

// Output the iCalendar data to a file
file_put_contents('out/events.ics', $calendar);
