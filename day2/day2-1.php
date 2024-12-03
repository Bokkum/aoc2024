<?php

$input = explode("\n", file_get_contents('input.txt'));

$reports = [];

foreach ($input as $line) {
    $levels = explode(' ', $line);
    $reports[] = $levels;
}

$safe = [];

foreach ($reports as $report) {
    $decreasing = false;
    $increasing = false;
    $similar = false;
    $last_level = $report[0];
    echo $last_level;
    $counter = 0;
    foreach ($report as $level) {
        if ($counter != 0) {
            if ($level > $last_level) {
                $increasing = true;
            } else if ($level < $last_level) {
                $decreasing = true;
            } else if ($level = $last_level) {
                $similar = true;
            }
            $last_level = $level;
        }
        $counter++;
    }

    $danger = false;
    if ($decreasing && $increasing) {
        $danger = true;
    }
    if ($similar) {
        $danger = true;
    }

    if (!$danger) {
        $safe[] = $report;
    }
}

$safest = [];

foreach ($safe as $report) {
    $danger = false;
    foreach ($report as $level) {
        if (current($report) !== $level) {
            $difference = abs($level - $last_level);

            if ($difference > 3) {
                $danger = true;
            }
        }
        $last_level = $level;
    }

    if (!$danger) {
        $safest[] = $report;
    }
}

$count = count($safest);

echo "<pre>";
echo print_r($safest, true);
echo "</pre>";

echo $count;
