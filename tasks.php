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
        <div id="message-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="dash-column">
        <div class="dash-header">Tasks</div>
        <div class="dash-content">
            <?php
            require_once "tasks-functions.php";
            $tasks = getTasks();
            foreach ($tasks as $task): ?>
                <div class="dash-item">
                    <span data-task-id="<?= $task[0]?>"><?=$task[1]?></span>
                    <span class="link"><a id="task-edit-link-<?= $task[0]?>" href="form-task.php?id=<?= $task[0]?>">Edit</a> <br></span>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php $checked = ($i <= $task[2]) ? "checked" : "";?>
                    <input type="radio" value ="<?= $i?>" <?php if(!empty($checked)): ?> checked="checked" <?php endif;?>>
                         <?php endfor; ?>
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