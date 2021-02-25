<?php

declare(strict_types=1);

function _is_empty_string($value)
{
    return is_string($value) && trim($value) === '';
}

function _is_full_string($value)
{
    return is_string($value) && trim($value) !== '';
}
