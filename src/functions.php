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

if (!function_exists('json_encode_320')) {
    function json_encode_320($value): string {
        return json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }
}

if (!function_exists('json_decode_320')) {
    function json_decode_320(string $value): array {
        return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
    }
}

