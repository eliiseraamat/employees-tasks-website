<?php

function getAverageWinterTemp(int $winterStartYear, int $winterEndYear): float {
    $inputFile = fopen("../ex1/data/temperatures-filtered.csv", "r");
    $count = 0;
    $total = 0;
    while(! feof($inputFile)) {
        $dict = fgetcsv($inputFile);
        if ($dict !== false && ((intval($dict[0]) === $winterStartYear && intval($dict[1]) === 12)
            || (intval($dict[0]) === $winterEndYear && intval($dict[1]) === 1)
            || (intval($dict[0]) === $winterEndYear && intval($dict[1]) === 2))) {
            $total += floatval($dict[4]);
            $count++;
        }

    }
    fclose($inputFile);
    return round($total / $count, 2);
}
