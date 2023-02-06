# Calendar Blocker

This tool creates calendar blocker slots based on your priority areas.
The blocker slots are for your upcoming week.
You can import the blocker slots into any calendar as they are in `*.ics` format.

## What works

- Creating slot settings
    - Copy config: `cp config.php.example config.php`
    - Adjust slot settings
- Creating an calendar file with events and title list
    - Create output folder: `mkdir out`
    - `php main.php`
    - Find output in `out`

## What does not work yet

- Timezones: Without timezone, I need to deduct one hour from settings file for MEZ winter time