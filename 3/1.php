<?php

$lines = explode(PHP_EOL, file_get_contents('./input.txt'));
$values = [];

for ($i=0; $i < count($lines); $i++) {
    unset($partNumbers, $partNumbersToCheck, $prev, $next, $scope);

    preg_match_all('/[^a-zA-Z0-9_.\n](\d+)|(\d+)(?=[^a-zA-Z0-9_.\n])/', $lines[$i], $partNumbers);
    preg_match_all('/(?=(^|\.)(\d+)(\.|$))/', $lines[$i], $partNumbersToCheck, PREG_OFFSET_CAPTURE);
    preg_match_all('/([^a-zA-Z0-9_.])/', $lines[$i-1] ?? '', $prev, PREG_OFFSET_CAPTURE);
    preg_match_all('/([^a-zA-Z0-9_.])/', $lines[$i+1] ?? '', $next, PREG_OFFSET_CAPTURE);

    // save already identified part numbers
    array_shift($partNumbers);
    array_push($values, ...array_filter(array_merge_recursive([], ...$partNumbers)));

    // check possible part numbers against previous and next lines
    $partNumbersToCheck = array_filter(array_merge_recursive([], $partNumbersToCheck[2]));
    $prev = $prev[0];
    $next = $next[0];

    foreach ($partNumbersToCheck as $possiblePartNumber) {
        // valid positions of symbol to define a part number
        $scope = range(
            $possiblePartNumber[1] -1, // from leading diagonal
            $possiblePartNumber[1] + strlen($possiblePartNumber[0]) // to ending diagonal
        );

        // search symbol in previous line
        foreach ($prev as $symbol) {
            if (in_array($symbol[1], $scope)) {
                array_push($values, $possiblePartNumber[0]);
                break 1;
            }
        }
        // search symbol in next line
        foreach ($next as $symbol) {
            if (in_array($symbol[1], $scope)) {
                array_push($values, $possiblePartNumber[0]);
                break 1;
            }
        }
    }
}
var_dump($values);
print(array_sum($values));
