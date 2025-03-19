<?php

declare(strict_types=1);

if (!function_exists('pf_is_string_filled')) {
    function pf_is_string_filled($value, bool $allowNumeric = false): bool {
        if (is_string($value)) {
            return trim($value) !== '';
        }

        if ($allowNumeric) {
            return is_int($value) || is_float($value);
        }

        return false;
    }
}

if (!function_exists('pf_is_string_empty')) {
    function pf_is_string_empty($value): bool {
        return is_string($value) && trim($value) === '';
    }
}

if (!function_exists('pf_is_array_filled')) {
    function pf_is_array_filled($value): bool {
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
    function pf_is_array_empty($value): bool {
        if (is_array($value)) {
            return count($value) === 0;
        }

        return false;
    }
}

if (!function_exists('pf_is_true')) {
    function pf_is_true($value): bool {
        return in_array($value, [true, 1, 'true', '1', 'True', 'TRUE', 'on', 'On', 'ON', 'Yes', 'yes', 'YES'], true);
    }
}

if (!function_exists('pf_is_false')) {
    function pf_is_false($value): bool {
        return in_array($value, [false, 0, 'false', '0', 'False', 'FALSE', 'off', 'Off', 'OFF', 'No', 'no', 'NO'], true);
    }
}
