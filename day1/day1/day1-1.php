<?php

$input = explode("\n", file_get_contents('input.txt'));

$first = [];
$second = [];

foreach ($input as $line) {
    $parts = explode('   ', $line);
    $first[] = $parts[0];
    $second[] = $parts[1];
}

sort($first);
sort($second);

$key = 0;
foreach($first as $line) {
    $comparison_array[] = array($first[$key], $second[$key]);
    $key++;
}

$total = 0;

foreach ($comparison_array as $line) {
    $diff = abs($line[1] - $line[0]);
    $total += $diff;
}

echo $total;