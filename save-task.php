<?php

require_once "tasks-functions.php";
require_once "ex6/connection.php";

$description = $_POST["description"] ?? null;
$estimate = $_POST["estimate"] ?? "0";
$message = "";
$delete = $_POST["deleteButton"] ?? "";
$id = $_POST["id"] ?? "";
$employeeID = $_POST["employeeId"] ?? -1;
$isCompleted = $_POST["isCompleted"] ?? false;


if ($delete) {
    deleteTask($id);
    $message = "Task deleted!";
    include "tasks.php";
} else if ($id) {
    updateTask($id, $description, $estimate, $employeeID, $isCompleted);
    $message = "Task updated!";
    include "tasks.php";
} else if ($description == null || strlen($description) < 5 || strlen($description) > 40) {
    $message = "Description must be 5-40 characters!";
    include "form-task.php";
} else {
    saveTask($description, $estimate, $employeeID);
    $message = "Task saved!";
    include "tasks.php";
}
