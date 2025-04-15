<?php

if (!function_exists('Debug')) {
    function Debug($string, $exit = true)
    {
        echo "<pre>";
        print_r($string);
        echo "</pre>";

        if ($exit) {
            exit;
        }
    }
}

if (!function_exists('DebugDump')) {
    function DebugDump($dump, $exit = true)
    {
        var_dump($dump);

        if ($exit) {
            exit;
        }
    }
}

if (!function_exists('formataSegundos')) {
    function formataSegundos($segundos)
    {
        $minutos = floor($segundos / 60);
        $segundosRestantes = $segundos % 60;
        return "{$minutos}:{$segundosRestantes}";
    }
}
