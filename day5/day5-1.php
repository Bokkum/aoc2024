<?php
$input = explode("\n\r\n", file_get_contents('input.txt'));

$rules_input = explode("\n", $input[0]);
$rules = [];
foreach ($rules_input as $rule) {
    $rules[] = explode("|", $rule);
}

$updates_input = explode("\n", $input[1]);
$updates = [];
foreach ($updates_input as $update) {
    $updates[] = explode(",", $update);
}

$succeeded_updates = [];
$failed_updates = [];
foreach ($updates as $update) {
    $active_rules = find_active_rules($rules, $update);
    $failed = false;
    foreach ($update as $key => $page) {
        $page_ordering = find_page_ordering($active_rules, $page);
        $pages_after = $page_ordering['after'];
        $pages_before = $page_ordering['before'];
        foreach ($pages_after as $page_after) {
            $after_key = array_search($page_after, $update);
            if ($after_key < $key) {
                $failed = true;
            }
        }
        foreach ($pages_before as $page_before) {
            $before_key = array_search($page_before, $update);
            if ($before_key > $key) {
                $failed = true;
            }
        }
    }

    if ($failed) {
        $failed_updates[] = $update;
    } else {
        $succeeded_updates[] = $update;
    }
}

$total = 0;
foreach ($succeeded_updates as $update) {
    $length = count($update);
    $middle = $update[($length - 1) / 2];
    $total += $middle;
}

echo "TOTAL = " . $total;

// echo "Succeeded<br>";
// echo "<pre>";
// echo print_r($succeeded_updates, true);
// echo "</pre>";

// echo "Failed<br>";
// echo "<pre>";
// echo print_r($failed_updates, true);
// echo "</pre>";


// echo "rules<br>";
// echo "<pre>";
// echo print_r($rules, true);
// echo "</pre>";

// echo "Updates<br>";
// echo "<pre>";
// echo print_r($updates, true);
// echo "</pre>";

function find_page_ordering($rules, $page_number) {
    $pages_before = [];
    $pages_after = [];
    foreach ($rules as $rule) {
        if ($rule[1] == $page_number) {
            $pages_before[] = $rule[0];
        } else if ($rule[0] == $page_number) {
            $pages_after[] = $rule[1];
        }
    }
    $result = ['after' => $pages_after, 'before' => $pages_before];

    return $result;
}

function find_active_rules($rules, $update) {
    $active_rules = [];
    foreach ($rules as $rule) {
        if (in_array($rule[0], $update) && in_array($rule[1], $update))
        $active_rules[] = $rule;
    }
    return $active_rules;
}

