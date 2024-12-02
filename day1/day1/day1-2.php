<?php

$input = explode("\n", file_get_contents('input.txt'));

$first = [];
$second = [];

foreach ($input as $line) {
    $parts = explode('   ', $line);
    $first[] = $parts[0];
    $second[] = $parts[1];
}

$sim_score = 0;
foreach ($first as $line1) {
    $count = 0;
    foreach($second as $line2) {
        if ($line1 == $line2) {
            $count++;
        }
    }
    $sim_score += ($line1 * $count);
}

echo $sim_score;