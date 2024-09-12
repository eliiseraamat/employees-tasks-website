<?php

require_once '../ex1/ex7.php';
require_once '../ex1/ex8.php';
require_once 'functions.php';

$opts = getopt('c:y:t:', ['command:', 'year:', 'temp:']);

$command = $opts['command'] ?? $opts['c'] ?? null;

if ($command === 'days-under-temp') {
    if (!array_key_exists('year', $opts) || !array_key_exists('temp', $opts)) {
        showError('year or temperature is missing or is unknown');
    } else {
        print getDaysUnderTemp($opts['year'], $opts['temp']);
    }

} else if ($command === 'days-under-temp-dict') {
    if (is_null($opts['temp'])) {
        showError('year or temperature is missing or is unknown');
    } else {
        $result = getDaysUnderTempDictionary($opts['temp']);
        print dictToString($result);
    }
} else if ($command === 'avg-winter-temp') {
    if (is_null($opts['year'])) {
        showError('years are missing or is unknown');
    } else {
        $years = explode('/', $opts['year']);
        print getAverageWinterTemp($years[0], $years[1]);
    }
} else {
    showError('command is missing or is unknown');
}

function showError(string $message): void {
    fwrite(STDERR, $message . PHP_EOL);
    exit(1);
}
