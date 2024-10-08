<?php

require_once "employees-functions.php";

$firstName = $_POST["firstName"] ?? "";
$lastName = $_POST["lastName"] ?? "";
$message = "";
$delete = $_POST["deleteButton"] ?? "";
$id = $_POST["id"] ?? "";
$picture = "";


if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        $picture = $target_file;
    }
}

if ($delete) {
    deleteEmployee($id);
    $message = "Employee deleted!";
    include "employees.php";
} else if ($id) {
    updateEmployee($id, $firstName, $lastName, $picture);
    $message = "Employee updated!";
    include "employees.php";
} else if (empty($firstName) || strlen($firstName) > 21) {
    $message = "The length of the first name must be 1-21 characters!";
    include "form-employee.php";
} else if (empty($lastName) || strlen($lastName) > 22 || strlen($lastName) < 2) {
    $message = "The length of the last name must be 2-22 characters!";
    include "form-employee.php";
} else {
    saveEmployee($firstName, $lastName, $picture);
    $message = "Employee saved!";
    include "employees.php";
}
