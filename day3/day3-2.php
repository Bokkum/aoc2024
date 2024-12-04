<?php
$input = file_get_contents('input.txt');

preg_match_all('/'. ('mul'. preg_quote('(') . '[0-9]{1,3},[0-9]{1,3}' . preg_quote(')')) . '|' . ('do' . preg_quote('()')) . '|' . ("don't" . preg_quote('()')) . '/', $input, $matches);

echo "<pre>";
echo print_r($matches[0], true);
echo "</pre>";

$multiplied = 0;
$doing = true;
foreach ($matches[0] as $match) {
    if ($match == 'do()') {
        $doing = true;
    } else if ($match == "don't()") {
        $doing = false;
    } else if ($doing == true) {
        preg_match_all('/[0-9]{1,3},[0-9]{1,3}/', $match, $line);
        $imploded = implode($line[0]);
        $parts = explode(',', $imploded);
        $multiplied += $parts[0] * $parts[1];
    }
}

echo $multiplied;