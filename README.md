# Calendar Blocker 🗓️

A productivity tool to automatically generate time blocking slots in your calendar based on priority areas (tactical, operational, strategical).

## Features

- 🕒 Automatic time slot generation based on working hours
- 📊 Priority-based slot distribution (tactical/operational/strategical)
- 📅 Generates .ics calendar files for easy import
- 📝 Creates a CSV file of all slot titles for reference
- ⚙️ Fully configurable through config.php

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Create config file: `cp config.php.example config.php`
4. Create output directory: `mkdir out`

## Usage

1. Configure your settings in `config.php`:
   - Working hours
   - Break times
   - Slot duration
   - Priority distribution
2. Run the generator: `php main.php`
3. Import the generated files:
   - `out/events.ics` to your calendar
   - Use `out/event_titles.csv` as a reference

## Output Files

- `events.ics`: Calendar file with all time blocks
- `event_titles.csv`: List of all generated slot titles

## Configuration Options

- Working hours (start/end)
- Break times (start/end)
- Slot duration (minutes)
- Break duration between slots (minutes)
- Priority distribution percentages

## Known Limitations

- ⏰ Timezone support not yet implemented (adjust manually for MEZ winter time)
- 📅 Currently generates slots for one week only
- 🔄 No automatic calendar sync (manual import required)

## Dependencies

- [Carbon](https://carbon.nesbot.com/) for date/time handling
- [Spatie iCalendar Generator](https://github.com/spatie/icalendar-generator) for .ics file generation
- [Unique Names Generator](https://github.com/chypriote/unique-names-generator) for slot titles

## Contributing

Contributions are welcome! Please open an issue or pull request for any improvements.
