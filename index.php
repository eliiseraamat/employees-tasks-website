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
                <div class="dash-item">Daisy Smith <br> Manager</div>
                <div class="dash-item">Josh Smith <br> Manager</div>
            </div>
        </div>

        <div class="dash-column">
            <div class="dash-header">Tasks</div>
            <div class="dash-content">
                <div class="dash-item">Prevent clearing CSS added to node after ... <br> <input type="checkbox" value="yes"><input type="checkbox" value="yes"><input type="checkbox" value="yes"><input type="checkbox" value="yes"><input type="checkbox" value="yes"> Pending</div>
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
