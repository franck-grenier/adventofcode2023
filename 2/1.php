<?php

$games = explode(PHP_EOL, file_get_contents('./input.txt'));
$maxReds = 12;
$maxGreens = 13;
$maxBlues = 14;
$values = [];

foreach ($games as $game) {
    [$id, $grabs] = explode(':', $game);
    $isPossible = true;

    foreach (explode(';', $grabs) as $cubes) {
        $reds = $greens = $blues = [];

        preg_match_all('/(\d+) red/', $cubes, $reds);
        preg_match_all('/(\d+) green/', $cubes, $greens);
        preg_match_all('/(\d+) blue/', $cubes, $blues);

        $reds = array_map(fn($value) => (int) $value, $reds[1]);
        $greens = array_map(fn($value) => (int) $value, $greens[1]);
        $blues = array_map(fn($value) => (int) $value, $blues[1]);

        if (array_sum($reds) > $maxReds || array_sum($greens) > $maxGreens || array_sum($blues) > $maxBlues) {
            $isPossible = false;
            break;
        }
    }

    if ($isPossible) {
        $values[] = (int) substr($id, 5);
    }
}

print(array_sum($values));
