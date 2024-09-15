<?php

function dd($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function url($path){
    return BASE_URL ."index.php?page=" . $path ;
    die;
}
function redirect($path)
{
    header("Location: " .BASE_URL . "index.php?page=" . $path);
    die;
}

function checkRequestMethod($method)
{
    if ($_SERVER['REQUEST_METHOD'] == $method) {
        return true;
    }
    return false;
}

// for check if there name has benn entered or not
function checkInput($input)
{
    if (isset($_POST[$input])) {
        return true;
    }
    return false;
}

// remove all spaces from the input
function sanitizeInput($input)
{
    return trim(htmlspecialchars(htmlentities($input)));
}

function getSession($name){
    return $_SESSION[$name] ?? false;
}

function number($phone){
    return !is_numeric($phone);
}