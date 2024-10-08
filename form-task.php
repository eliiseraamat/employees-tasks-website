<?php

require_once "tasks-functions.php";

$id = $_GET["id"] ?? null;

if ($id != null) {
    $data = getTask($id);
    $description = $data[0] ?? null;
    $estimate = $data[1] ?? null;
    if ($description == null || $estimate == null) {
        $message = "Employee not found";
    }
}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? "Edit Task" : "Add Task" ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="task-form-page">

<div id="base">

<nav>
    <a href="index.php" id="dashboard-link">Dashboard </a> |
    <a href="employees.php" id ="employee-list-link">Employees </a> |
    <a href="form-employee.php" id="employee-form-link">Add Employee </a> |
    <a href="tasks.php" id="task-list-link">Tasks </a> |
    <a href="" id="task-form-link">Add Task </a>
</nav>

<main>

    <?php if (!empty($message)): ?>
        <div id="error-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="dash-column">
        <div class="dash-header"><?= $id ? "Edit Task" : "Add Task" ?></div>
        <div class="dash-content">
            <form id="input-form" method="post" action="save-task.php">
                <input type="hidden" value=<?=$id?> name="id">
                <div class="label-cell"><label for="desc">Description:</label></div>
                <div class="input-cell"><textarea name="description" id="desc"><?php if (!empty($description)) {print $description;} ?></textarea></div>
                <div class="label-cell">Estimate:</div>
                <div class="input-cell">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <label>
                        <input type="radio"
                               name="estimate"
                               value="<?= $i?>"
                        <?php if (!empty($estimate) && $estimate == $i):?>
                        checked="checked"
                        <?php endif; ?>
                        > <?= $i ?>
                    </label>
                    <?php endfor; ?>
                </div>
                <div class="label-cell"></div>
                <div class="input-cell"> <br> <button name="submitButton" type="submit" value="1">Save</button></div>
                <?php if ($id): ?>
                    <div class="label-cell"></div>
                    <div class="input-cell"> <br> <button name="deleteButton" type="submit" value="2">Delete</button></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</main>

<footer>
    icd0007 Sample Application
</footer>

</div>

</body>
</html>