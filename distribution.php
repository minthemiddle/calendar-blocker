<?php
require 'vendor/autoload.php';

require_once __DIR__ . 'config.php';
require_once __DIR__ . 'slots.php';

$priority_slots = [];
$allocated_slots = 0;
foreach ($priorities as $priority) {
    $priority_slots[$key] = floor(count($slots) * ($priority[''] / 100));
    $allocated_slots += $priority_slots[$key];
}

// If all slots are not allocated, allocate the remaining slots to the last item in the array
$priority_slots[array_key_last($priority_slots)] += $availableSlots - $allocated_slots;