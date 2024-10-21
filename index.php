<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="dashboard-page">

<div id="base">

    <nav>
        <a href="" id="dashboard-link">Dashboard </a> |
        <a href="employees.php" id ="employee-list-link">Employees </a> |
        <a href="form-employee.php" id="employee-form-link">Add Employee </a> |
        <a href="tasks.php" id="task-list-link">Tasks </a> |
        <a href="form-task.php" id="task-form-link">Add Task </a>
    </nav>

    <main>
        <div id="dashboard">
            <div class="dash-column">
                <div class="dash-header">Employees</div>
                <div class="dash-content">
                    <?php
                    require_once "employees-functions.php";
                    $employees = getEmployees();
                    $data = getEmployeeTasks();
                    foreach ($employees as $employee): ?>
                        <div class="dash-item">
                            <?php if (!$employee->picture) {$picture = "img/profile.png";} else {$picture = $employee->picture;}?>
                            <img src="<?=$picture?>" data-employee-id="<?=$employee->id?>" alt="profile picture" >
                            <span data-employee-id="<?= $employee->id?>"><?=$employee->firstName?> <?=$employee->lastName?></span>
                            <span id="employee-task-count-<?=$employee->id?>" class="count"><?=$data[$employee->id]?></span>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>

            <div class="dash-column">
                <div class="dash-header">Tasks</div>
                <div class="dash-content">
                    <?php
                    require_once "tasks-functions.php";
                    $tasks = getTasks();
                    foreach ($tasks as $task): ?>
                        <div class="task">
                            <div class="title"><div data-task-id="<?= $task->id?>"><?=$task->description?></div></div><br>
                        <div id="task-state-<?=$task->id?>" class="status <?=strtolower($task->status)?>"><?=$task->status?></div>
                        <div class="dots">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div <?php if($i <= $task->estimate):?> class="filled" <?php endif;?>> </div>
                            <?php endfor; ?>
                        </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>

    </main>

    <footer>
        icd0007 Sample Application
    </footer>

</div>

</body>
</html>