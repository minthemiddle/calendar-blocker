<?php
require 'vendor/autoload.php';

use Carbon\Carbon;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Enums\Classification;

require 'slots.php';

foreach ($slots as $slot) {
    $events[] = Event::create()
        ->name('🚧 Blocker: ')
        ->description('ID: ' . $slot['title'])
        ->startsAt(Carbon::today()->addDays($slot['day'])->setTime($slot['start_hour'], $slot['start_minutes']))
        ->endsAt(Carbon::today()->addDays($slot['day'])->setTime($slot['end_hour'], $slot['end_minutes']))
        ->classification(Classification::private());
}

// Create iCalendar data
$calendar = Calendar::create('Blocker')
    ->event($events)
    ->get();

// Output the iCalendar data to a file
file_put_contents('out/events.ics', $calendar);

// Create the CSV file

$fp = fopen('out/event_titles.csv', 'w');

foreach ($titles as $title) {
    fwrite($fp, $title);
    fwrite($fp, PHP_EOL);
}

fclose($fp);
