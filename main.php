<?php
require 'vendor/autoload.php';

use Carbon\Carbon;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Components\Calendar;

// Define the four events
$events[] = Event::create()
    ->name('Blocker')
    ->startsAt(Carbon::tomorrow()->setTime(9, 0))
    ->endsAt(Carbon::tomorrow()->setTime(11, 0));
$events[] = Event::create()
    ->name('Blocker 2')
    ->startsAt(Carbon::tomorrow()->addDay()->setTime(9, 0))
    ->endsAt(Carbon::tomorrow()->addDay()->setTime(11, 0));
$events[] = Event::create()
    ->name('Blocker 3')
    ->startsAt(Carbon::tomorrow()->addDays(2)->setTime(9, 0))
    ->endsAt(Carbon::tomorrow()->addDays(2)->setTime(11, 0));
$events[] = Event::create()
    ->name('Blocker 4')
    ->startsAt(Carbon::tomorrow()->addDays(3)->setTime(9, 0))
    ->endsAt(Carbon::tomorrow()->addDays(3)->setTime(11, 0));

// Create iCalendar data
$calendar = Calendar::create('Blocker')
    ->event($events)
    ->get();

// Output the iCalendar data to a file
file_put_contents('events.ics', $calendar);
