<?php

declare(strict_types=1);

if (!function_exists('htmlspecialchars_utf8')) {
    function htmlspecialchars_utf8(string $str, bool $double_encode = true): string {
        return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', $double_encode);
    }
}

if (!function_exists('htmlspecialchars_utf8_mixed')) {
    function htmlspecialchars_utf8_mixed($value, bool $double_encode = true): string {
        if ($value === null) {
            return 'null';
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }

        if (is_string($value)) {
            return htmlspecialchars_utf8($value, $double_encode);
        }

        throw new InvalidArgumentException("Invalid argument type [" . gettype($value) . "] for htmlspecialchars_utf8_mixed()");
    }
}
