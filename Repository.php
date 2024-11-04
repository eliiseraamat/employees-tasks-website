<?php

require_once "ex6/connection.php";
require_once "Task.php";
require_once "Employee.php";
class Repository {

    private $conn;

    private function getDbConnection() {
        if ($this->conn === null) {
            $this->conn = getConnection();
        }
        return $this->conn;
    }

    function saveEmployee(Employee $employee) : void {
        $stmt = $this->getDbConnection()->prepare("INSERT INTO employee (first_name, last_name, picture) VALUES (:firstName, :lastName, :picture)");
        $stmt->bindValue(':firstName', $employee->firstName);
        $stmt->bindValue(':lastName', $employee->lastName);
        $stmt->bindValue(':picture', $employee->picture);
        $stmt->execute();
    }

    function getEmployees() : array {
        $stmt = $this->getDbConnection()->prepare('SELECT id, first_name, last_name, picture FROM employee ORDER BY id');
        $stmt->execute();
        $employees = [];
        foreach ($stmt as $row) {
            $id = $row['id'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $picture = $row['picture'];
            $newEmployee = new Employee($firstName, $lastName, $picture, $id);
            $employees[] = $newEmployee;
        }
        return $employees;
    }

    function getEmployee(string $employeeID) : Employee {
        $stmt = $this->getDbConnection()->prepare('SELECT first_name, last_name, picture FROM employee where id = (:employeeID)');
        $stmt->bindValue(':employeeID', intval($employeeID));
        $stmt->execute();
        foreach ($stmt as $row) {
            $firstName = $row["first_name"];
            $lastName = $row["last_name"];
            $picture = $row["picture"];
            return new Employee($firstName, $lastName, $picture, $employeeID);
        }
        return new Employee(null, null, null, null);
    }

    function deleteEmployee(Employee $employee) : void {
        $stmt = $this->getDbConnection()->prepare('DELETE from employee where id = (:employeeID)');
        $stmt->bindValue(':employeeID', $employee->id);
        $stmt->execute();
    }

    function updateEmployee(Employee $employee) : void {
        $stmt = $this->getDbConnection()->prepare('UPDATE employee set first_name = (:firstName), last_name = (:lastName), picture = (:picture) where id = (:employeeID)');
        $stmt->bindValue(':employeeID', intval($employee->id));
        $stmt->bindValue(':firstName', $employee->firstName);
        $stmt->bindValue(':lastName', $employee->lastName);
        $stmt->bindValue(':picture', $employee->picture);
        $stmt->execute();
    }

    function getEmployeeTasks() : array {
        $stmt = $this->getDbConnection()->prepare('SELECT e.id, t.description from employee e left join task t on e.id = t.employee_id');
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

    function saveTask(Task $task) : void {
        $stmt = $this->getDbConnection()->prepare("INSERT INTO task (description, estimate, employee_id, status) VALUES (:description, :estimate, :employeeID, :status)");
        $stmt->bindValue(':description', $task->description);
        $stmt->bindValue(':estimate', $task->estimate);
        $stmt->bindValue(':employeeID', $task->employee_id);
        $stmt->bindValue(':status', $task->status);
        $stmt->execute();
    }

    function getTasks() : array {
        $stmt = $this->getDbConnection()->prepare('SELECT id, description, estimate, employee_id, status FROM task ORDER BY id');
        $stmt->execute();
        $tasks = [];
        foreach ($stmt as $row) {
            $id = $row['id'];
            $description = urldecode($row['description']);
            $estimate = intval($row['estimate']);
            $employeeID = intval($row["employee_id"]);
            $status = $row["status"];
            $newTask = new Task($description, $estimate, $employeeID, $status, $id);
            $tasks[] = $newTask;
        }
        return $tasks;
    }

    function getTask(string $taskID) : Task {
        $stmt = $this->getDbConnection()->prepare('SELECT description, estimate, employee_id, status FROM task where id = (:taskID)');
        $stmt->bindValue(':taskID', intval($taskID));
        $stmt->execute();
        foreach ($stmt as $row) {
            $description = urldecode($row["description"]);
            $estimate = intval($row["estimate"]);
            $employeeID = intval($row["employee_id"]);;
            $status = $row["status"];
            return new Task($description, $estimate, $employeeID, $status, $taskID);
        }
        return new Task(null, 0, 0, null, null);
    }

    function deleteTask(Task $task) : void {
        $stmt = $this->getDbConnection()->prepare('DELETE from task where id = (:taskID)');
        $stmt->bindValue(':taskID', $task->id);
        $stmt->execute();
    }

    function updateTask(Task $task) : void {
        $stmt = $this->getDbConnection()->prepare('UPDATE task set description = (:description), estimate = (:estimate), employee_id = (:employeeID), status = (:status) where id = (:taskID)');
        $stmt->bindValue(':taskID', $task->id);
        $stmt->bindValue(':description', $task->description);
        $stmt->bindValue(':estimate', $task->estimate);
        $stmt->bindValue(':employeeID', $task->employee_id);
        $stmt->bindValue(':status', $task->status);
        $stmt->execute();
    }
}
