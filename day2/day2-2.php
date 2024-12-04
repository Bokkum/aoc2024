<pre>
<?php

$input = explode("\n", file_get_contents('input.txt'));

$reports = [];

foreach ($input as $line) {
    $levels = explode(' ', $line);
    $reports[] = $levels;
}

$safe = [];

foreach ($reports as $report) {
    $base_array = $report;
    
    $stop = false;
    for ($x = 0; $x <= (count($report) + 1); $x++) {

        if ($stop) {
            break;
        }
        $report = $base_array;
        $counter = 0;

        $decreasing = false;
        $increasing = false;
        $similar = false;
        $danger = false;

        if ($x != 0) {
            array_splice($report, ($x - 1), 1);
        }
        $last_level = $report[0];

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
                } else {
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
        }
    }
}
$count = count($safe);

echo $count;
