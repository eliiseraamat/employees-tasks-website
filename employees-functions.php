<?php

const DATA_FILE = "employees.txt";

function saveEmployee(string $firstName, string $lastName, string $picture) : void {
    $id = getNewId();
    $line = $id . ";" . urlencode($firstName) . ";" . urlencode($lastName) . ";" . urlencode($picture) . PHP_EOL;
    file_put_contents(DATA_FILE, $line, FILE_APPEND);
}

function getNewId(): string {
    $id = file_get_contents("next-employee-id.txt");
    file_put_contents("next-employee-id.txt", intval($id) + 1);
    return $id;
}

function getEmployees() : array {
    $employees = [];
    $lines = file(DATA_FILE);
    foreach ($lines as $line) {
        [$id, $firstName, $lastName, $picture] = explode(";", trim($line));
        $employees[] = [$id, urldecode($firstName) . " " . urldecode($lastName), urldecode($picture)];
    }
    return $employees;
}

function getEmployee(string $employeeID) : array {
    $employees = getEmployees();
    foreach ($employees as $line) {
        [$id, $name, $picture] = [$line[0], $line[1], $line[2]];
        if ($id === $employeeID) {
            [$firstName, $lastName] = explode(" ", $name);
            return [$firstName, $lastName, $picture];
        }
    }
    return [];
}

function deleteEmployee(string $employeeID) : void {
    $employees = getEmployees();
    $lines = [];
    foreach ($employees as $employee) {
        [$id, $name, $picture] = [$employee[0], $employee[1], $employee[2]];
        if ($id !== $employeeID) {
            [$firstName, $lastName] = explode(" ", $name);
            $lines[] = $id . ";" . urlencode($firstName) . ";" . urlencode($lastName) . ";" . urlencode($picture) . PHP_EOL;
        }
    }
    file_put_contents(DATA_FILE, implode("", $lines));
}

function updateEmployee(string $employeeID, string $newFirstName, string $newLastName, string $newPicture) : void {
    $employees = getEmployees();
    $lines = [];
    foreach ($employees as $employee) {
        [$id, $name, $picture] = [$employee[0], $employee[1], $employee[2]];
        if ($id !== $employeeID) {
            [$firstName, $lastName] = explode(" ", $name);
            $lines[] = $id . ";" . urlencode($firstName) . ";" . urlencode($lastName) . ";" . urlencode($picture) . PHP_EOL;
        } else {
            $lines[] = $id . ";" . urlencode($newFirstName) . ";" . urlencode($newLastName) . ";" . urlencode($newPicture) . PHP_EOL;
    }
    file_put_contents(DATA_FILE, implode("", $lines));
    }
}
