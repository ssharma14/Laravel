<?php

return [
    'rate_limit' => (int) env('CONTACT_RATE_LIMIT', 2),
    'rate_decay' => (int) env('CONTACT_RATE_DECAY', 10),
    'min_fill_time' => (int) env('CONTACT_MIN_FILL_TIME', 5),
];
