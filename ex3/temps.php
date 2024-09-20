<?php

ini_set('display_errors', '1');

require_once '../ex1/ex7.php';
require_once '../ex2/functions.php';

$command = $_POST['command'] ?? 'show-form';
$year = $_POST['year'] ?? null;
$temp = $_POST['temp'] ?? null;


if ($command === 'avg-winter-temp') {
    $message = getAverageWinterTemp(intval(explode("/", $year)[0]), intval(explode("/", $year)[1]));
    include "pages/result.php";
} else if ($command === 'days-under-temp') {
    $message = getDaysUnderTemp(intval($year), intval(@$temp));
    include 'pages/result.php';
} else if ($_GET['page'] === 'avg-winter-temp') {
    include 'pages/avg-winter-temp.php';
}  else if ($command === 'show-form') {
    include 'pages/days-under-temp.php';
} else {
    throw new Error('unknown command: ' . $command);
}
