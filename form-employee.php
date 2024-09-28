<?php

require_once "employees.php";

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];

if (empty($firstName) || empty($lastName)) {
    print "Please add first name and last name.";
} else {
    saveEmployee($firstName, $lastName);
    header('Location: employees.php');
}
