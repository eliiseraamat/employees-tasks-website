<?php

require_once "ex6/connection.php";
require_once "Employee.php";

function saveEmployee(string $firstName, string $lastName, string $picture) : void {
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO employee (first_name, last_name, picture) VALUES (:firstName, :lastName, :picture)");
    $stmt->bindValue(':firstName', urlencode($firstName));
    $stmt->bindValue(':lastName', urlencode($lastName));
    $stmt->bindValue(':picture', urlencode($picture));
    $stmt->execute();
}

function getEmployees() : array {
    $conn = getConnection();
    $stmt = $conn->prepare('SELECT id, first_name, last_name, picture FROM employee ORDER BY id');
    $stmt->execute();
    $employees = [];
    foreach ($stmt as $row) {
        $id = $row['id'];
        $firstName = urldecode($row['first_name']);
        $lastName = urldecode($row['last_name']);
        $picture = urldecode($row['picture']);
        $newEmployee = new Employee($id, $firstName, $lastName, $picture);
        $employees[] = $newEmployee;
    }
    return $employees;
}

function getEmployee(string $employeeID) : Employee {
    $conn = getConnection();
    $stmt = $conn->prepare('SELECT first_name, last_name, picture FROM employee where id = (:employeeID)');
    $stmt->bindValue(':employeeID', intval($employeeID));
    $stmt->execute();
    foreach ($stmt as $row) {
        $firstName = urldecode($row["first_name"]);
        $lastName = urldecode($row["last_name"]);
        $picture = urldecode($row["picture"]);
        return new Employee($employeeID, $firstName, $lastName, $picture);
    }
    return new Employee((int)null, null, null, null);
}

function deleteEmployee(string $employeeID) : void {
    $conn = getConnection();
    $stmt = $conn->prepare('DELETE from employee where id = (:employeeID)');
    $stmt->bindValue(':employeeID', intval($employeeID));
    $stmt->execute();
}

function updateEmployee(string $employeeID, string $newFirstName, string $newLastName, string $newPicture) : void {
    $conn = getConnection();
    $stmt = $conn->prepare('UPDATE employee set first_name = (:firstName), last_name = (:lastName), picture = (:picture) where id = (:employeeID)');
    $stmt->bindValue(':employeeID', intval($employeeID));
    $stmt->bindValue(':firstName', urlencode($newFirstName));
    $stmt->bindValue(':lastName', urlencode($newLastName));
    $stmt->bindValue(':picture', urlencode($newPicture));
    $stmt->execute();
}

function getEmployeeTasks() : array {
    $conn = getConnection();
    $stmt = $conn->prepare('SELECT e.id, t.description from employee e left join task t on e.id = t.employee_id');
    $stmt->execute();
    $dict = [];
    foreach ($stmt as $row) {
        if (isset($dict[$row["id"]]) && $row["description"] !== null) {
            $dict[$row["id"]] += 1;
        } else if (!isset($dict[$row["id"]]) && $row["description"] !== null) {
            $dict[$row["id"]] = 1;
        } else {
            $dict[$row["id"]] = 0;
        }
    }
    return $dict;
}

