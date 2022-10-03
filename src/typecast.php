<?php

declare(strict_types=1);

if (!function_exists('pf_str_or_null')) {
    function pf_str_or_null($value, bool $onlyFilledString = true, bool $alterValueUsingTrim = true): ?string
    {
        if (is_numeric($value) && !is_string($value)) {
            $value = (string)$value;
        }

        if (is_string($value)) {
            if ($alterValueUsingTrim) {
                $value = trim($value);
            }

            if ($onlyFilledString && trim($value) === '') {
                return null;
            }

            return $value;
        }

        return null;
    }
}

if (!function_exists('pf_string_argument')) {
    function pf_string_argument($value, $forNull = '', $forTrue = true, $forFalse = false)
    {
        if ($value === null) {
            return $forNull;
        }

        if ($value === true) {
            return $forTrue;
        }

        if ($value === false) {
            return $forFalse;
        }

        if (is_string($value)) {
            return $value;
        }

        if (is_int($value) || is_float($value)) {
            return ((string)$value);
        }

        return $value;
    }
}

if (!function_exists('pf_numeric_to_int')) {
    function pf_numeric_to_int($value)
    {
        if ($value === '0' || $value === '-0') {
            return 0;
        }

        if (
            is_string($value)
            && is_numeric($value)
            && (mb_strpos_utf8($value, '.') === false)
            && (mb_strpos_utf8($value, '0') !== 0)
            && (mb_strpos_utf8($value, '-0') !== 0)
        ) {
            return (int) $value;
        }

        return $value;
    }
}
