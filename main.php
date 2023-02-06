<?php
require 'vendor/autoload.php';

use Carbon\Carbon;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Components\Calendar;


// Create iCalendar data
$calendar = Calendar::create('Blocker')
    ->event($events)
    ->get();

// Output the iCalendar data to a file
file_put_contents('events.ics', $calendar);
