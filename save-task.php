<?php

require_once "tasks-functions.php";
require_once "ex6/connection.php";

$description = $_POST["description"] ?? null;
$estimate = $_POST["estimate"] ?? 0;
$message = "";
$delete = $_POST["deleteButton"] ?? "";
$id = $_POST["id"] ?? "";
$employeeID = $_POST["employeeId"] ?? 0;
$isCompleted = $_POST["isCompleted"] ?? false;

if (!is_numeric($estimate)) {
    $estimate = 0;
}
if (!is_numeric($employeeID)) {
    $employeeID = 0;
}

if ($delete) {
    deleteTask($id);
    $message = urlencode("Task deleted!");
    header("location: tasks.php?message=$message");
} else if ($id) {
    updateTask($id, $description, $estimate, $employeeID, $isCompleted);
    $message = urlencode("Task updated!");
    header("location: tasks.php?message=$message");
} else if ($description == null || strlen($description) < 5 || strlen($description) > 40) {
    $message = urlencode("Description must be 5-40 characters!");
    include "form-task.php";
} else {
    saveTask($description, $estimate, $employeeID);
    $message = urlencode("Task saved!");
    header("location: tasks.php?message=$message");
}
