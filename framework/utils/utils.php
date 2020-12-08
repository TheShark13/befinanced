<?php

function dump($content)
{
    echo '<pre>';
    var_dump($content);
    echo '</pre>';
}

function dashesToCamelCase(string $string, bool $capitalizeFirstCharacter = false)
{
    $string = str_replace('_id', '', $string);

    $str = str_replace('_', '', ucwords($string, '_'));

    if (!$capitalizeFirstCharacter) {
        $str = lcfirst($str);
    }

    return $str;
}

function camelToUnderscore(string $string, string $us = "_")
{
    return strtolower(preg_replace(
        '/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/', $us, $string));
}

function getCsrfToken(): ?string
{
    return isset($_SESSION['token']) ? $_SESSION['token'] : null;
}