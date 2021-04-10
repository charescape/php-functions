<?php

declare(strict_types=1);

if (!function_exists('_is_empty_string')) {
    /**
     * @deprecated since 1.0.0
     */
    function _is_empty_string($value)
    {
        return is_string($value) && trim($value) === '';
    }
}

if (!function_exists('_is_full_string')) {
    /**
     * @deprecated since 1.0.0
     */
    function _is_full_string($value)
    {
        return is_string($value) && trim($value) !== '';
    }
}

if (!function_exists('_minify_html')) {
    /**
     * @deprecated since 1.0.0
     */
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

if (!function_exists('mb_strpos_utf8')) {
    /**
     * @param string $haystack The string being checked.
     * @param string $needle The string to find in haystack.
     * @return false|int Returns the numeric position of the first occurrence of needle in the haystack string. If needle is not found, it returns false.
     */
    function mb_strpos_utf8(string $haystack , string $needle) {
        return mb_strpos($haystack, $needle, 0, 'UTF-8');
    }
}

if (!function_exists('pf_query_string')) {
    function pf_query_string(bool $with_prefix = true): string {
        if (!isset($_SERVER['QUERY_STRING'])) {
            return '';
        }

        if (_is_empty_string($_SERVER['QUERY_STRING'])) {
            return '';
        }

        return ($with_prefix ? '?' : '') . trim($_SERVER['QUERY_STRING']);
    }
}

if (!function_exists('pf_http_build_query_rfc3986')) {
    function pf_http_build_query_rfc3986(array $query): string {
        return http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    }
}

if (!function_exists('pf_split_string_using_rn')) {
    function pf_split_string_using_rn(string $haystack): array {
        return preg_split('/\r\n|\n|\r/', $haystack);
    }
}

if (!function_exists('pf_urlsafe_b64encode')) {
    function pf_urlsafe_b64encode(string $s): string {
        return str_replace(['+', '/', '='], ['-', '_', '.'], base64_encode($s));
    }
}

if (!function_exists('pf_urlsafe_b64decode')) {
    function pf_urlsafe_b64decode(string $s): string {
        return base64_encode(str_replace(['-', '_', '.'], ['+', '/', '='], $s));
    }
}

if (!function_exists('pf_mt_rand')) {
    function pf_mt_rand(int $min, int $max): int {
        return mt_rand($min, $max);
    }
}
