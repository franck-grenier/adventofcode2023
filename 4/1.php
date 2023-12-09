<?php

$cards = explode(PHP_EOL, file_get_contents('./input.txt'));
$total = 0;

foreach ($cards as $card) {
    $points = 0;
    [$winningNums, $myNums] = explode(' | ', explode(':', $card)[1]);
    $winningNums = array_filter(explode(' ', $winningNums));
    $myNums = array_filter(explode(' ', $myNums));
    $result = array_values(array_intersect($winningNums, $myNums));

    foreach ($result as $key => $match) {
        $points = $key === 0 ? 1 : $points * 2;
    };
    $total += $points;
}

print($total);
