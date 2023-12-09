<?php

$lines = explode(PHP_EOL, file_get_contents('./input.txt'));
$values = [];

for ($i=0; $i < count($lines); $i++) {
    preg_match_all('/\*/', $lines[$i], $possibleGears, PREG_OFFSET_CAPTURE);
    // coordinates : [x = line, y = offset]
    $targets = [
        [-1, -1],    [-1, 0],     [-1, 1],
        [ 0, -1],                 [ 0, 1],
        [ 1, -1],    [ 1, 0],     [ 1, 1]
    ];
    foreach ($possibleGears[0] as $possibleGear) {
        array_walk($targets, function ($target) use ($lines, $i, $possibleGear) {
            $x = $i + $target[0];
            $y = $possibleGear[1] + $target[1];

            if (is_numeric($lines[$x][$y])) {
                print(substr($lines[$x], 0, $possibleGear[1]) . PHP_EOL);
                $number = trim(substr(substr($lines[$x], 0, $possibleGear[1]), 3 * $target[1]), '.');
                print($number . PHP_EOL);
            }
        });
    };
}

var_dump($values);
print(array_sum($values));
