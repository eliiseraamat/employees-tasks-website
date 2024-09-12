<?php

function getDaysUnderTempDictionary(float $targetTemp): array {
    $inputFile = fopen(__DIR__ . '/data/temperatures-filtered.csv', "r");
    $data = [];
    while(! feof($inputFile)) {
        $dict = fgetcsv($inputFile);
        if ($dict !== false && floatval($dict[4]) <= $targetTemp) {
            if (!array_key_exists($dict[0], $data)) {
                $data[$dict[0]] = 1;
            } else {
                $data[$dict[0]]++;
            }
        }
    }
    fclose($inputFile);
    foreach ($data as $key => $value) {
        $data[$key] = round($value / 24, 2);
    }
    return $data;
}

function dictToString(array $dict): string {
    $result = [];
    foreach ($dict as $key => $value) {
        $result[] = $key . " => " . $value;
    }
    return "[" . implode(", ", $result) . "]";
}
