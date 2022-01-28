<?php

declare(strict_types=1);

if (!function_exists('pf_str_or_null')) {
    function pf_str_or_null($value, bool $onlyFilledString = true, bool $useTrim = true): ?string
    {
        if (is_numeric($value) && !is_string($value)) {
            $value = (string)$value;
        }

        if (is_string($value)) {
            if ($useTrim) {
                $value = trim($value);
            }

            if ($onlyFilledString && $value === '') {
                return null;
            }

            return $value;
        }

        return null;
    }
}
