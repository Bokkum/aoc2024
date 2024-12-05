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

$test = search_grid('XMAS', $grid);

function search_grid($search, $grid)
{
    $word = str_split($search);

    $directions = [ 
        [0,1],
        [0,-1],
        [1,0],
        [-1,0],
        [1,1],
        [1,-1],
        [-1,1],
        [-1,-1],
    ];

    $count = 0;

    // Find  letter in the grid
    $locations = find_letter_location($word[0], $grid);
    foreach ($locations as $location) {
        foreach($directions as $direction) {
            $result = [$word[0]];
            $next_location = $location;
            for ($i = 1; $i < count($word); $i++) {
                $next_location['column'] = $next_location['column'] + $direction[0];
                $next_location['row'] = $next_location['row'] + $direction[1];
                if ($next_location['column'] >= count($grid[0])) {
                    break;
                }
                if ($next_location['column'] < 0) {
                    break;
                }
                if ($next_location['row'] >= count($grid)) {
                    break;
                }
                if ($next_location['row'] < 0) {
                    break;
                }
                $result[] = retrieve_letter_from_grid($next_location, $grid);
            }
            if (implode($result) == 'XMAS') {
                $count++;
            }
        }
    }
    echo $count;
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