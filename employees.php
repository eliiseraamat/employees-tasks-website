<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="employee-list-page">

<div id="base">

<nav>
    <a href="index.php" id="dashboard-link">Dashboard </a> |
    <a href="" id ="employee-list-link">Employees </a> |
    <a href="form-employee.php" id="employee-form-link">Add Employee </a> |
    <a href="tasks.php" id="task-list-link">Tasks </a> |
    <a href="form-task.php" id="task-form-link">Add Task </a>
</nav>

<main>

    <?php if (!empty($message)): ?>
        <div id="message-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="dash-column">
        <div class="dash-header">Employees</div>
        <div class="dash-content">
            <?php
            require_once "employees-functions.php";
            $employees = getEmployees();
            foreach ($employees as $employee): ?>
                <div class="dash-item">
                    <?php if (!$employee[2]) {$picture = "img/profile.png";} else {$picture = $employee[2];}?>
                    <img src="<?=$picture?>" data-employee-id="<?=$employee[0]?>" alt="profile picture" />
                    <span data-employee-id="<?= $employee[0]?>"><?=$employee[1]?></span>
                    <span class="link"><a id="employee-edit-link-<?= $employee[0]?>" href="form-employee.php?id=<?= $employee[0]?>">Edit</a></span>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</main>

<footer>
    icd0007 Sample Application
</footer>

</div>

</body>
</html>