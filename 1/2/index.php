<?php

$input = explode(PHP_EOL, file_get_contents('./input.txt'));
$words = [
    'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'
];
$pattern = implode('|', $words);
$values = [];

foreach ($input as $calibration) {
    preg_match_all('/(?=(\d|'.$pattern.'))/', $calibration, $matches);
    $values[] = preg_replace_callback(
        '/'.$pattern.'/',
        fn ($repl) => array_search($repl[0], $words) + 1,
        $matches[1][0] . end($matches[1])
    );
}

print(array_sum($values));
