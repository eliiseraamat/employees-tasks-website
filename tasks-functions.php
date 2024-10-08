<?php

const DATA_FILE = 'tasks.txt';

function saveTask(string $description, string $estimate) : void {
    $id = getNewId();
    $line = $id . ";" . urlencode($description) . ";" . urlencode($estimate) . PHP_EOL;
    file_put_contents(DATA_FILE, $line, FILE_APPEND);
}

function getNewId(): string {
    $id = file_get_contents("next-task-id.txt");
    file_put_contents("next-task-id.txt", intval($id) + 1);
    return $id;
}

function getTasks() : array {
    $tasks = [];
    $lines = file(DATA_FILE);
    foreach ($lines as $line) {
        [$id, $description, $estimate] = explode(';', trim($line));
        $tasks[] = [$id, urldecode($description), urldecode($estimate)];
    }
    return $tasks;
}

function getTask(string $taskID) : array {
    $tasks = getTasks();
    foreach ($tasks as $line) {
        [$id, $description, $estimate] = [$line[0], $line[1], $line[2]];
        if ($id == $taskID) {
            return [$description, $estimate];
        }
    }
    return [];
}

function deleteTask(string $taskID) : void {
    $tasks = getTasks();
    $lines = [];
    foreach ($tasks as $task) {
        [$id, $description, $estimate] = [$task[0], $task[1], $task[2]];
        if ($id !== $taskID) {
            $lines[] = $id . ";" . urlencode($description) . ";" . urlencode($estimate) . PHP_EOL;
        }
    }
    file_put_contents(DATA_FILE, implode("", $lines));
}

function updateTask(string $taskID, string $newDescription, string $newEstimate) : void {
    $tasks = gettasks();
    $lines = [];
    foreach ($tasks as $task) {
        [$id, $description, $estimate] = [$task[0], $task[1], $task[2]];
        if ($id !== $taskID) {
            $lines[] = $id . ";" . urlencode($description) . ";" . urlencode($estimate) . PHP_EOL;
        } else {
            $lines[] = $id . ";" . urlencode($newDescription) . ";" . urlencode($newEstimate) . PHP_EOL;
        }
        file_put_contents(DATA_FILE, implode("", $lines));
    }
}
