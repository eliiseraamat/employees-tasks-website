<?php

require 'ex8/vendor/autoload.php';
require_once 'Repository.php';

$repository = new Repository();

$cmd = $_REQUEST['cmd'] ?? 'dashboard';
$idGet = $_GET["id"] ?? null;
$idPost = $_POST["id"] ?? null;
$message = $_GET["message"] ?? null;
$firstName = $_POST["firstName"] ?? "";
$lastName = $_POST["lastName"] ?? "";
$picture = '';
$description = $_POST["description"] ?? "";
$estimate = $_POST["estimate"] ?? "";
$employee_ID = $_POST["employeeId"] ?? 0;
$isCompleted = $_POST["isCompleted"] ?? false;

if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        $picture = $target_file;
    }
}

if ($cmd === 'dashboard') {
    $data = [
        'title' => "Dashboard",
        'body' => 'dashboard-page'
    ];

    render('dashboard.latte', $data);

} else if ($cmd === 'employee-list') {
    $data = [
        'message' => $message,
        'title' => "Employees",
        'body' => 'employee-list-page'
    ];

    render('employee-list.latte', $data);

} else if ($cmd === 'employee-form') {
    $data = [
        'message' => $message,
        'title' => "Employee Form",
        'body' => 'employee-form-page',
        'id' => $idGet,
        'firstName' => $firstName,
        'lastName' => $lastName,
    ];
    render('employee-form.latte', $data);

} else if ($cmd === 'task-list') {
    $data = [
        'message' => $message,
        'title' => "Tasks",
        'body' => 'task-list-page'
    ];
    render('task-list.latte', $data);

}else if ($cmd === 'task-form') {
    $data = [
        'message' => $message,
        'title' => "Task Form",
        'body' => 'task-form-page',
        'id' => $idGet,
        'description' => $description,
        'estimate' => $estimate,
    ];
    render('task-form.latte', $data);

} else if ($cmd === 'employee-save') {
    $employee = new Employee($firstName, $lastName, $picture, intval($idPost));
    $errors = validateEmployee($employee);
    if ($errors) {
        $data = [
            'message' => $errors,
            'title' => "Employee Form",
            'body' => 'employee-form-page',
            'id' => $idPost,
            'firstName' => $firstName,
            'lastName' => $lastName,
        ];
        render('employee-form.latte', $data);
    } else if ($idPost) {
        $repository->updateEmployee($employee);
        $message = urlencode('Employee updated!');
        header("Location: ?cmd=employee-list&message={$message}");
    } else {
        $repository->saveEmployee($employee);
        $message = urlencode('Employee saved!');
        header("Location: ?cmd=employee-list&message={$message}");
    }

} else if ($cmd === 'employee-delete') {
    $employee = $repository->getEmployee($idPost);
    $repository->deleteEmployee($employee);
    $message = urlencode("Employee deleted!");
    header("Location: ?cmd=employee-list&message={$message}");

} else if ($cmd === 'employee-edit') {
    $employee = $repository->getEmployee($idGet);
    $data = [
        'id' => $idGet,
        'firstName' => $employee->firstName,
        'lastName' => $employee->lastName,
        'message' => $message,
        'title' => "Employee Form",
        'body' => 'employee-form-page',
    ];
    render('employee-form.latte', $data);

} else if ($cmd === 'task-save') {
    if ($isCompleted) {
        $status = 'Closed';
    } else if (intval($employee_ID) === 0) {
        $status = 'Open';
    } else {
        $status = 'Pending';
    }
    $task = new Task($description, intval($estimate), intval($employee_ID), $status, intval($idPost));
    $errors = validateTask($task);
    if ($errors) {
        $data = [
            'message' => $errors,
            'title' => "Task Form",
            'body' => 'task-form-page',
            'id' => $idPost,
            'description' => $description,
            'estimate' => $estimate,
            'isCompleted' => $isCompleted,
            'employeeID' => $employee_ID,
        ];
        render('task-form.latte', $data);
    } else if ($idPost) {
        $repository->updateTask($task);
        $message = urlencode('Task updated!');
        header("Location: ?cmd=task-list&message={$message}");
    } else {
        $repository->saveTask($task);
        $message = urlencode('Task saved!');
        header("Location: ?cmd=task-list&message={$message}");
    }

} else if ($cmd === 'task-delete') {
    $task = $repository->getTask($idPost);
    $repository->deleteTask($task);
    $message = urlencode("Task deleted!");
    header("Location: ?cmd=task-list&message={$message}");

} else if ($cmd === 'task-edit') {
    $task = $repository->getTask($idGet);
    $data = [
        'id' => $idGet,
        'description' => $task->description,
        'estimate' => $task->estimate,
        'employeeID' => $task->employee_id,
        'isCompleted' => $task->status === 'Closed',
        'message' => $message,
        'body' => 'task-form-page',
        'title' => "Task Form",
    ];
    render('task-form.latte', $data);
}

function render(string $subTemplate, array $data): void {
    global $repository;
    $latte = new Latte\Engine;
    $latte->render("main.latte", [...$data, 'template' => $subTemplate, 'repository' => $repository]);
}

function validateEmployee(?Employee $employee): array {
    $errors = [];
    if (empty($employee->firstName) || strlen($employee->firstName) > 21) {
        $errors[] = 'The length of the first name must be 1-21 characters!';
    }
    if ((empty($employee->lastName) || strlen($employee->lastName) > 22 || strlen($employee->lastName) < 2)) {
        $errors[] = 'The length of the last name must be 2-22 characters!';
    }
    return $errors;
}

function validateTask(?Task $task): array {
    $errors = [];
    if ($task->description == null || strlen($task->description) < 5 || strlen($task->description) > 40) {
        $errors[] = 'Description must be 5-40 characters!';
    }
    return $errors;
}
