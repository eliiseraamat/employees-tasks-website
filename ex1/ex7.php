<?php

function getDaysUnderTemp(int $targetYear, float $targetTemp): float {
    $inputFile = fopen("data/temperatures-filtered.csv", "r");
    $count = 0;
    while(! feof($inputFile)) {
        $dict = fgetcsv($inputFile);
        if ($dict !== false && intval($dict[0]) === $targetYear && floatval($dict[4]) <= $targetTemp) {
            $count++;
        }

    }
    fclose($inputFile);
    return round($count / 24, 2);
}
