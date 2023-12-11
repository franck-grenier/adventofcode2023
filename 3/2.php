<?php

$lines = explode(PHP_EOL, file_get_contents('./input.txt'));
// coordinates : [x = line, y = offset]
$targets = [
    [-1, -1],       [-1, 0],         [-1, 1],
    [ 0, -1],                        [ 0, 1],
    [ 1, -1],       [ 1, 0],         [ 1, 1],
];
$values = [];

for ($i=0; $i < count($lines); $i++) {
    preg_match_all('/\*/', $lines[$i], $possibleGears, PREG_OFFSET_CAPTURE);

    foreach ($possibleGears[0] as $possibleGear) {
        $gearNumbers = [];
        foreach($targets as $target) {
            $x = $i + $target[0];
            $y = $possibleGear[1] + $target[1];

            if (is_numeric($lines[$x][$y])) {
                print("Found adjacent numeric in line {$lines[$x]} at offest {$y}" . PHP_EOL);
                $searchOffset = $y - 3;
                $searchOffset = $searchOffset < 0 ? 0 : $searchOffset;
                print("Regexp search number at offest {$searchOffset}" . PHP_EOL);
                if (preg_match('/\d+/', $lines[$x], offset: $searchOffset, matches: $numbers)) {
                    // TODO: replace found numbers by "..." to avoid overlapsing
                    preg_replace('/\d+/', '.', substr($lines[$x],$searchOffset, 3));
                    var_dump($numbers);
                    print("Found number {$numbers[0]}" . PHP_EOL);
                    $gearNumbers[] = $numbers[0];
                };
                if (count($gearNumbers) === 2) {
                    print("Found 2 gear numbers {$gearNumbers[0]} * {$gearNumbers[1]}" . PHP_EOL);
                    array_push($values, $gearNumbers[0] * $gearNumbers[1]);
                    break 1;
                }
            }
        };
    };
}

print(array_sum($values));
