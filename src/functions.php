<?php

declare(strict_types=1);

if (!function_exists('_is_empty_string')) {
    function _is_empty_string($value)
    {
        return is_string($value) && trim($value) === '';
    }
}

if (!function_exists('_is_full_string')) {
    function _is_full_string($value)
    {
        return is_string($value) && trim($value) !== '';
    }
}

if (!function_exists('_minify_html')) {
    function _minify_html(string $html): string {
        $html = preg_replace('/^\s+[<]+/m', '<', $html);

        return $html;
    }
}

