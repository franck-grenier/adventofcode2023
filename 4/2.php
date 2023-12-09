<?php

$cards = explode(PHP_EOL, file_get_contents('./input.txt'));
$i = 0;
$copies = [];

while ($i < count($cards)) {
    [$winningNums, $myNums] = explode(' | ', explode(':', $cards[$i])[1]);
    $winningNums = array_filter(explode(' ', $winningNums));
    $myNums = array_filter(explode(' ', $myNums));
    $results = array_values(array_intersect($winningNums, $myNums));

    foreach ($results as $j => $result) {
        $copies[] = $cards[$i+$j+1];
    };
    $cards = array_slice($cards, 0, $i) +
        $copies +
        array_slice($cards, $i, count($cards)-$i);
    $i++;
}

var_dump($cards, count($cards));
