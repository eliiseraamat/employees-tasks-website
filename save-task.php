<?php

require_once "tasks-functions.php";

$description = $_POST["description"] ?? null;
$estimate = $_POST["estimate"] ?? "0";
$message = "";
$delete = $_POST["deleteButton"] ?? "";
$id = $_POST["id"] ?? "";

if ($delete) {
    deleteTask($id);
    $message = "Task deleted!";
    include "tasks.php";
} else if ($id) {
    updateTask($id, $description, $estimate);
    $message = "Task updated!";
    include "tasks.php";
} else if ($description == null || strlen($description) < 5 || strlen($description) > 40) {
    $message = "Description must be 5-40 characters!";
    include "form-task.php";
} else {
    saveTask($description, $estimate);
    $message = "Task saved!";
    include "tasks.php";
}
