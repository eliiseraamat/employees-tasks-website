<?php

const DATA_FILE = 'tasks.txt';

function saveTask(string $description, string $estimate) : void {
    $line = urlencode($description) . ";" . urlencode($estimate) . PHP_EOL;
    file_put_contents(DATA_FILE, $line, FILE_APPEND);
}
function getTasks() : array {
    $tasks = [];
    $lines = file(DATA_FILE);
    foreach ($lines as $line) {
        [$description, $estimate] = explode(';', trim($line));
        $tasks[] = [urldecode($description), urldecode($estimate)];
    }
    return $tasks;
}
