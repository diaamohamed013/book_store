<?php
// validation name

// require name
function inpRequire($input)
{
    if (empty($input)) {
        return true;
    }
    return false;
}

// min val for name

function minVal($input, $len)
{
    if (strlen($input) < $len) {
        return true;
    }
    return false;
}

// max val for name

function maxVal($input, $len)
{
    if (strlen($input) > $len) {
        return true;
    }
    return false;
}

// validation email
function emailValid($input)
{
    if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}
