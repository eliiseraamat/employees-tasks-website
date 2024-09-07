<?php

$input = '[1, 4, 2, 0]';

function stringToIntegerList(string $input): array {
    $input = str_replace("[", "", $input);
    $input = str_replace("]", "", $input);
    $list = explode(", ", $input);
    $result = [];
     foreach ($list as $element) {
        $result[] = intval($element);
    };
    return $result;
}
