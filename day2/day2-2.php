<?php

$input = explode("\n", file_get_contents('input.txt'));

$reports = [];

foreach ($input as $line) {
    $levels = explode(' ', $line);
    $reports[] = $levels;
}

$safe = [];

$unsafe = [];

foreach ($reports as $report) {
    $base_array = $report;

    echo "---";
    $stop = false;
    for ($x = 0; $x <= (count($report) + 1); $x++) {
        if ($stop) {
            break;
        }
        $report = $base_array;
        $last_level = $report[0];
        $counter = 0;

        $decreasing = false;
        $increasing = false;
        $similar = false;
        $danger = false;

        if ($x != 0) {
            array_splice($report, ($x - 1), 1);
        }

        echo "<pre>";
        echo print_r($report, true);
        echo "</pre>";

        foreach ($report as $level) {
            if ($counter != 0) {
                $difference = abs($level - $last_level);

                if ($difference > 3) {
                    $danger = true;
                }

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

        if ($decreasing && $increasing) {
            $danger = true;
        }
        if ($similar) {
            $danger = true;
        }

        if (!$danger) {
            $safe[] = $report;
            $stop = true;
            echo "<br>succes<br>";
            $unsafe[] = $base_array;
        }
    }
    echo "----";
}

echo "<pre>";
echo print_r($unsafe, true);
echo "</pre>";



// echo "<pre>";
// echo print_r($safe, true);
// echo "</pre>";

// $count = count($safe);

// echo $count;