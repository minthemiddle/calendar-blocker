<?php
require 'vendor/autoload.php';

// Distribution

$hop = [
    'tactical' => 10,
    'operational' => 20,
    'strategical' => 70,
];
$availableSlots = 23;

$hop_slots = [];
$allocatedSlots = 0;
foreach ($hop as $key => $value) {
    $hop_slots[$key] = floor($availableSlots * ($value / 100));
    $allocatedSlots += $hop_slots[$key];
}

// If all slots are not allocated, allocate the remaining slots to the last item in the array
$hop_slots[array_key_last($hop_slots)] += $availableSlots - $allocatedSlots;

print_r($hop_slots);
