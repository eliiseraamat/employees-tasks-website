<?php

require_once "employees-functions.php";

$id = $_GET["id"] ?? null;

if ($id != null) {
    $data = getEmployee($id);
    $firstName = $data->firstName ?? null;
    $lastName = $data->lastName ?? null;
    $picture = $data->picture ?? null;
    if ($firstName == null || $lastName == null) {
        $message = "Employee not found";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? "Edit Employee" : "Add Employee" ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="employee-form-page">

<div id="base">

<nav>
    <a href="index.php" id="dashboard-link">Dashboard </a> |
    <a href="employees.php" id ="employee-list-link">Employees </a> |
    <a href="" id="employee-form-link">Add Employee </a> |
    <a href="tasks.php" id="task-list-link">Tasks </a> |
    <a href="form-task.php" id="task-form-link">Add Task </a>
</nav>

<main>

    <?php if (!empty($message)): ?>
        <div id="error-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="dash-column">
        <div class="dash-header"><?= $id ? "Edit Employee" : "Add Employee" ?></div>
        <div class="dash-content">
            <form id="input-form" method="post" action="save-employee.php" enctype="multipart/form-data">
                <input type="hidden" value=<?=$id?> name="id">
                <div class="label-cell"><label for="fn">First name:</label></div>
                <div class="input-cell"><input name="firstName" id="fn" type="text"<?php if (!empty($firstName)): ?> value="<?=htmlspecialchars($firstName)?>"<?php endif; ?>></div>
                <div class="label-cell"><label for="ln">Last name:</label></div>
                <div class="input-cell"><input name="lastName" id="ln" type="text"<?php if (!empty($lastName)): ?> value="<?=htmlspecialchars($lastName)?>"<?php endif; ?>></div>
                <div class="label-cell"><label for="picture">Picture:</label></div>
                <div class="input-cell"><input id="picture" name="picture" type="file" /></div>
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