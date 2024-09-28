<?php

require_once "tasks-functions.php";

$description = $_POST["description"];
$estimate = $_POST["estimate"] ?? null;

if (empty($description) || $estimate == null) {
    print "Please add description and choose estimate.";
} else {
    saveTask($description, $estimate);
    header('Location: tasks.php');
}
