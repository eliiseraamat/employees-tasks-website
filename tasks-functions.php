<?php

require_once "ex6/connection.php";
require_once "Task.php";

function saveTask(string $description, string $estimate, string $employee_id) : int {
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO task (description, estimate, employee_id, is_completed, status) VALUES (:description, :estimate, :employeeID, :isCompleted, :status)");
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':estimate', $estimate);
    $stmt->bindValue(':employeeID', $employee_id);
    $stmt->bindValue(':isCompleted', 0);
    if ($employee_id < 0) {
        $stmt->bindValue(':status', "Open");
    } else {
        $stmt->bindValue(':status', "Pending");
    }
    $stmt->execute();
    return $conn->lastInsertId();
}

function getTasks() : array {
    $conn = getConnection();
    $stmt = $conn->prepare('SELECT id, description, estimate, employee_id, is_completed, status FROM task ORDER BY id');
    $stmt->execute();
    $tasks = [];
    foreach ($stmt as $row) {
        $id = $row['id'];
        $description = $row['description'];
        $estimate = $row['estimate'];
        $employeeID = $row["employee_id"];
        $isCompleted = $row["is_completed"];
        $status = $row["status"];
        $newTask = new Task($id, $description, $estimate, $employeeID, $isCompleted, $status);
        $tasks[] = $newTask;
    }
    return $tasks;
}

function getTask(string $taskID) : Task {
    $conn = getConnection();
    $stmt = $conn->prepare('SELECT description, estimate, employee_id, is_completed, status FROM task where id = (:taskID)');
    $stmt->bindValue(':taskID', intval($taskID));
    $stmt->execute();
    foreach ($stmt as $row) {
        $description = $row["description"];
        $estimate = $row["estimate"];
        $employeeID = $row["employee_id"];
        $isCompleted = $row["is_completed"];
        $status = $row["status"];
        return new Task($taskID, $description, $estimate, $employeeID, $isCompleted, $status);
    }
    return new Task((int)null, null, null, null, null, null);
}

function deleteTask(string $taskID) : void {
    $conn = getConnection();
    $stmt = $conn->prepare('DELETE from task where id = (:taskID)');
    $stmt->bindValue(':taskID', intval($taskID));
    $stmt->execute();
}

function updateTask(string $taskID, string $newDescription, string $newEstimate, string $employeeID, bool $isCompleted) : void {
    $conn = getConnection();
    $stmt = $conn->prepare('UPDATE task set description = (:description), estimate = (:estimate), employee_id = (:employeeID), is_completed = (:isCompleted), status = (:status) where id = (:taskID)');
    $stmt->bindValue(':taskID', intval($taskID));
    $stmt->bindValue(':description', $newDescription);
    $stmt->bindValue(':estimate', $newEstimate);
    $stmt->bindValue(':employeeID', $employeeID);
    if ($isCompleted) {
        $stmt->bindValue(':isCompleted', 1);
    } else {
        $stmt->bindValue(':isCompleted', 0);
    }
    if ($employeeID < 0 && !$isCompleted) {
        $stmt->bindValue(':status', "Open");
    } else if ($employeeID > 0 && !$isCompleted) {
        $stmt->bindValue(':status', "Pending");
    } else {
        $stmt->bindValue(':status', "Closed");
    }
    $stmt->execute();
}
