<?php

$input = explode(PHP_EOL, file_get_contents('./input.txt'));
$values = [];

foreach ($input as $calibration) {
    preg_match_all('/\d/', $calibration, $matches);
    $values[] = $matches[0][0] . end($matches[0]);
}

print(array_sum($values));
