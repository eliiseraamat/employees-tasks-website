<?php

const DATA_FILE = "employees.txt";

function saveEmployee(string $firstName, string $lastName) : void {
    $line = urlencode($firstName) . ";" . urlencode($lastName) . PHP_EOL;
    file_put_contents(DATA_FILE, $line, FILE_APPEND);
}
function getEmployees() : array {
    $employees = [];
    $lines = file(DATA_FILE);
    foreach ($lines as $line) {
        [$firstName, $lastName] = explode(";", trim($line));
        $employees[] = urldecode($firstName). " " . urldecode($lastName);
    }
    return $employees;
}
