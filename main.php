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
    for ($day = $offset_days; $day < $days_to_generate; $day++) {
        $priority = array_shift($slots_priorities_and_titles);
        $startDateTime = Carbon::today()->addDays($day)->setTime($slot['start_hour'], $slot['start_minutes']);
        $endDateTime = Carbon::today()->addDays($day)->setTime($slot['end_hour'], $slot['end_minutes']);
        $events[] = Event::create()
            ->name('🚧 ' . $priority)
            ->description('Priority: ' . $priority . ', ID: ' . $slot['title'])
            ->startsAt($startDateTime)
            ->endsAt($endDateTime)
            ->classification(Classification::private());
    }
}

// Create iCalendar data
$calendar = Calendar::create('Blocker')
    ->event($events)
    ->get();

// Output the iCalendar data to a file
file_put_contents('out/events.ics', $calendar);
