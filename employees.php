<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees</title>
</head>
<body id="employee-list-page">

<table border="0" width="100%">
    <tr>
        <td></td>
        <td width="700px">
            <table border="0" width="100%">
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td><a href="index.php" id="dashboard-link">Dashboard</a> | <a href="" id ="employee-list-link">Employees</a> | <a href="form-employee.html" id="employee-form-link">Add Employee</a> | <a href="tasks.php" id="task-list-link">Tasks</a> | <a href="form-task.html" id="task-form-link">Add Task</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="1" width="100%">
                            <tr>
                                <th align="left" colspan="2">Employees</th>
                            </tr>
                            <?php
                            include "employees-functions.php";
                            $employees = getEmployees();
                            foreach ($employees as $employee): ?>
                            <tr>
                                <td><?=$employee?></td>
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