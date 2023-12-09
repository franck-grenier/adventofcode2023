<?php

$games = explode(PHP_EOL, file_get_contents('./input.txt'));
$values = [];

foreach ($games as $game) {
    [$id, $grabs] = explode(':', $game);
    $nbReds = $nbGreens = $nbBlues = [];

    foreach (explode(';', $grabs) as $cubes) {
        $reds = $greens = $blues = [];

        preg_match_all('/(\d+) red/', $cubes, $reds);
        preg_match_all('/(\d+) green/', $cubes, $greens);
        preg_match_all('/(\d+) blue/', $cubes, $blues);

        $reds = array_map(fn($value) => (int) $value, $reds[1]);
        $greens = array_map(fn($value) => (int) $value, $greens[1]);
        $blues = array_map(fn($value) => (int) $value, $blues[1]);

        $nbReds[] = $reds[0] ?? 0;
        $nbGreens[] = $greens[0] ?? 0;
        $nbBlues[] = $blues[0] ?? 0;
    }

    $values[] = max($nbReds) * max($nbGreens) * max($nbBlues);
}

print(array_sum($values));
