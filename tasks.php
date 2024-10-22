<?php
$message = $_GET["message"] ?? "";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="task-list-page">

<div id="base">

<nav>
    <a href="index.php" id="dashboard-link">Dashboard </a> |
    <a href="employees.php" id ="employee-list-link">Employees </a> |
    <a href="form-employee.php" id="employee-form-link">Add Employee </a> |
    <a href="" id="task-list-link">Tasks </a> |
    <a href="form-task.php" id="task-form-link">Add Task </a>
</nav>

<main>

    <?php if (!empty($message)): ?>
        <div id="message-block"><?= urldecode($message)?></div>
    <?php endif; ?>

    <div class="dash-column">
        <div class="dash-header">Tasks</div>
        <div class="dash-content">
            <?php
            require_once "tasks-functions.php";
            $tasks = getTasks();
            foreach ($tasks as $task): ?>
                <div class="task">
                    <span class="link"><a id="task-edit-link-<?= $task->id?>" href="form-task.php?id=<?= $task->id?>">Edit</a></span>
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
</main>

<footer>
    icd0007 Sample Application
</footer>

</div>

</body>
</html>
