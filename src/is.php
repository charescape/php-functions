<?php

declare(strict_types=1);

if (!function_exists('pf_is_array_filled')) {
    function pf_is_array_filled($value): bool
    {
        if (is_array($value)) {
            $n = count($value);

            if (is_int($n)) {
                return $n > 0;
            }
        }

        return false;
    }
}

if (!function_exists('pf_is_array_empty')) {
    function pf_is_array_empty($value): bool
    {
        if (is_array($value)) {
            return count($value) === 0;
        }

        return false;
    }
}
