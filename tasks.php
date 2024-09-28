<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks</title>
</head>
<body id="task-list-page">

<table border="0" width="100%">
    <tr>
        <td></td>
        <td width="700px">
            <table border="0" width="100%">
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td><a href="index.php" id="dashboard-link">Dashboard</a> | <a href="employees.php" id ="employee-list-link">Employees</a> | <a href="form-employee.html" id="employee-form-link">Add Employee</a> | <a href="" id="task-list-link">Tasks</a> | <a href="form-task.html" id="task-form-link">Add Task</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="1" width="100%">
                            <tr>
                                <th align="left" colspan="2">Tasks</th>
                            </tr>
                            <?php
                            include "tasks-functions.php";
                            $tasks = getTasks();
                            foreach ($tasks as $task): ?>
                                <tr>
                                    <td><?=$task[0]?> <br>
                                        <?php for ($i = 1; $i <= 5; $i++) {
                                            $checked = ($i <= $task[1]) ? "checked" : "";
                                            echo '<input type="radio" ' . $checked . '>';;
                                        } ?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center"><br><hr>icd0007 Sample Application</td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
</table>

</body>
</html>