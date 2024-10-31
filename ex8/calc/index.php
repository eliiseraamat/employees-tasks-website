<?php

require '../vendor/autoload.php';

$cmd = $_REQUEST['cmd'] ?? 'ctf_form';
$temperature = $_POST['temperature'] ?? null;

if ($cmd === 'ctf_form') {
    $data = [
        'cmd' => 'ctf_calculate',
        'title' => 'Celsius to Fahrenheit',
        'errors' => [],
        'temperature' => $temperature
    ];

    render('form_fragment.latte', $data);

} else if ($cmd === 'ftc_form') {
    $data = [
        'cmd' => 'ftc_calculate',
        'title' => 'Fahrenheit to Celsius',
        'errors' => [],
        'temperature' => $temperature
    ];

    render('form_fragment.latte', $data);

} else if ($cmd === 'ctf_calculate') {
    $errors = validate($temperature);
    $data = [
        'errors' => $errors,
        'title' => 'Celsius to Fahrenheit',
        'cmd' => 'ctf_calculate',
        'temperature' => $temperature
    ];
    if ($errors) {
        render('form_fragment.latte', $data);
        exit();
    }
    $input = $temperature;
    $result = celsiusToFahrenheit($input);
    $message = "$input degrees in Celsius is $result degrees in Fahrenheit";
    render('result_fragment.latte', ['message' => $message]);

} else if ($cmd === 'ftc_calculate') {
    $errors = validate($temperature);
    $data = [
        'errors' => $errors,
        'title' => 'Fahrenheit to Celsius',
        'cmd' => 'ftc_calculate',
        'temperature' => $temperature
    ];
    if ($errors) {
        render('form_fragment.latte', $data);
        exit();
    }
    $input = $temperature;
    $result = fahrenheitToCelsius($input);
    $message = "$input degrees in Fahrenheit is $result degrees in Celsius";
    render('result_fragment.latte', ['message' => $message]);

}else {
    throw new Error('programming error');
}

function render(string $subTemplate, array $data): void {
    $latte = new Latte\Engine;
    $latte->render("main.latte", [...$data, 'template' => $subTemplate]);
}

function validate(?string $temperature): array {
    return is_numeric($temperature)
        ? []
        : ['Temperature must be a number'];
}

function celsiusToFahrenheit($temp): float {
    return round($temp * 9 / 5 + 32, 2);
}

function fahrenheitToCelsius($temp): float {
    return round(($temp - 32) / (9 / 5), 2);
}
