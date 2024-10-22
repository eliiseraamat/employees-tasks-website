<?php

require_once "ex6/connection.php";
require_once "Task.php";

function saveTask(string $description, string $estimate, int $employee_id) : int {
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO task (description, estimate, employee_id, status) VALUES (:description, :estimate, :employeeID, :status)");
    $stmt->bindValue(':description', urlencode($description));
    $stmt->bindValue(':estimate', $estimate);
    $stmt->bindValue(':employeeID', $employee_id);
    if ($employee_id === 0) {
        $stmt->bindValue(':status', "Open");
    } else {
        $stmt->bindValue(':status', "Pending");
    }
    $stmt->execute();
    return $conn->lastInsertId();
}

function getTasks() : array {
    $conn = getConnection();
    $stmt = $conn->prepare('SELECT id, description, estimate, employee_id, status FROM task ORDER BY id');
    $stmt->execute();
    $tasks = [];
    foreach ($stmt as $row) {
        $id = $row['id'];
        $description = urldecode($row['description']);
        $estimate = intval($row['estimate']);
        $employeeID = intval($row["employee_id"]);
        $status = $row["status"];
        $newTask = new Task($id, $description, $estimate, $employeeID, $status);
        $tasks[] = $newTask;
    }
    return $tasks;
}

function getTask(string $taskID) : Task {
    $conn = getConnection();
    $stmt = $conn->prepare('SELECT description, estimate, employee_id, status FROM task where id = (:taskID)');
    $stmt->bindValue(':taskID', intval($taskID));
    $stmt->execute();
    foreach ($stmt as $row) {
        $description = urldecode($row["description"]);
        $estimate = intval($row["estimate"]);
        $employeeID = intval($row["employee_id"]);;
        $status = $row["status"];
        return new Task($taskID, $description, $estimate, $employeeID, $status);
    }
    return new Task((int)null, null, 0, 0, null);
}

function deleteTask(string $taskID) : void {
    $conn = getConnection();
    $stmt = $conn->prepare('DELETE from task where id = (:taskID)');
    $stmt->bindValue(':taskID', intval($taskID));
    $stmt->execute();
}

function updateTask(string $taskID, string $newDescription, int $newEstimate, int $employeeID, bool $isCompleted) : void {
    $conn = getConnection();
    $stmt = $conn->prepare('UPDATE task set description = (:description), estimate = (:estimate), employee_id = (:employeeID), status = (:status) where id = (:taskID)');
    $stmt->bindValue(':taskID', intval($taskID));
    $stmt->bindValue(':description', urlencode($newDescription));
    $stmt->bindValue(':estimate', $newEstimate);
    $stmt->bindValue(':employeeID', $employeeID);
    if ($employeeID === 0 && !$isCompleted) {
        $stmt->bindValue(':status', "Open");
    } else if ($employeeID !== 0 && !$isCompleted) {
        $stmt->bindValue(':status', "Pending");
    } else {
        $stmt->bindValue(':status', "Closed");
    }
    $stmt->execute();
}
