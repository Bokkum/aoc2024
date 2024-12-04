<?php
$input = file_get_contents('input-example.txt');

preg_match_all('/mul'. preg_quote('(') . '[0-9]{1,3},[0-9]{1,3}' . preg_quote(')') . '/', $input, $matches);

echo "<pre>";
echo print_r($matches[0], true);
echo "</pre>";

$multiplied = 0;

foreach ($matches[0] as $match) {
    preg_match_all('/[0-9]{1,3},[0-9]{1,3}/', $match, $line);
    $imploded = implode($line[0]);
    $parts = explode(',', $imploded);
    $multiplied += $parts[0] * $parts[1];
}

echo $multiplied;