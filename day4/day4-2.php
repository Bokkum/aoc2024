<?php
$input = explode("\n", file_get_contents('input.txt'));

echo "<pre>";
echo print_r($input, true);
echo "</pre>";

$grid = [];

foreach ($input as $row) {
    $grid_row = str_split($row);
    $grid[] = $grid_row;
}

echo "<pre>";
echo str_replace("\n", '', print_r($grid, true));
echo "</pre>";

$test = search_grid('MAS', $grid);

function search_grid($search, $grid)
{
    $directions = [ 
        [1,1],
        [1,-1],
        [-1,1],
        [-1,-1],
    ];

    $count = 0;

    // Find the A
    $locations = find_letter_location('A', $grid);

    foreach ($locations as $location) {
        $result = '';
        echo "<pre>";
        echo print_r($location, true);
        foreach ($directions as $direction) {
            $search_location = [
                'row' => ($location['row'] + $direction[0]), 
                'column' => ($location['column'] + $direction[1])
            ];
            if ($search_location['column'] >= count($grid[0])) {
                break;
            }
            if ($search_location['column'] < 0) {
                break;
            }
            if ($search_location['row'] >= count($grid)) {
                break;
            }
            if ($search_location['row'] < 0) {
                break;
            }
            $letter = retrieve_letter_from_grid($search_location, $grid);
            $result .= $letter;
        }
        if (in_array($result, array("SSMM", "SMSM", "MSMS", "MMSS"))) {
            $count++;
        }
    }

    echo "total = " . $count;
}

function find_letter_location($search_letter, $grid) {
    $locations = [];
    foreach ($grid as $grid_key => $grid_row) {
        foreach($grid_row as $row_key => $letter) {
            if ($letter == $search_letter) {
                $locations[] = ['row' => $grid_key, 'column' => $row_key];
            }
        }
    }
    return $locations;
}

function retrieve_letter_from_grid($search_location, $grid) {
    $row = $grid[$search_location['row']];
    $letter = $row[$search_location['column']];
    return $letter;
}