# Calendar Blocker 🗓️

A productivity tool to automatically generate time blocking slots in your calendar based on priority areas (tactical, operational, strategical).

## Features

- 🕒 Automatic time slot generation based on working hours
- ⏸️ Automatic break time handling
- 📊 Priority-based slot distribution (tactical/operational/strategical/OKR-KPI)
- 📅 Generates .ics calendar files for easy import
- 🏷️ Unique titles for each time slot
- ⚙️ Fully configurable through config.php

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Create config file: `cp config.php.example config.php`
4. Create output directory: `mkdir out`

## Usage

1. Configure your settings in `config.php`:
   - Working hours (day_start, day_end)
   - Break times (break_start, break_end)
   - Slot duration (timeSlotDuration)
   - Priority distribution percentages
   - Number of days to generate (days_to_generate)
2. Run the generator: `php main.php`
3. Import the generated file:
   - `out/events.ics` to your calendar
4. Calendar events will include:
   - Priority type (Tactical/Operational/Strategic/OKR-KPI)
   - Unique slot ID for reference

## Output Files

- `events.ics`: Calendar file with all time blocks
- `event_titles.csv`: List of all generated slot titles

## Configuration Options

- Working hours:
  - day_start: Start of workday (format: HHMM)
  - day_end: End of workday (format: HHMM)
- Break times:
  - break_start: Start of break (format: HHMM)
  - break_end: End of break (format: HHMM)
- Slot duration: timeSlotDuration (minutes)
- Priority distribution:
  - Tactical: Short-term work like feature scoping
  - Operational: Team alignment and roadmap management
  - Strategic: Long-term product positioning
  - OKR/KPI: Key results and metrics tracking
- days_to_generate: Number of days to create slots for

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
