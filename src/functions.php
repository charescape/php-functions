<?php

declare(strict_types=1);

use function Symfony\Component\String\u;

if (!function_exists('_is_empty_string')) {
    /**
     * @deprecated since 1.0.0
     */
    function _is_empty_string($value) {
        return is_string($value) && trim($value) === '';
    }
}

if (!function_exists('pf_is_empty_string')) {
    /**
     * @deprecated since 1.0.0
     */
    function pf_is_empty_string($value): bool {
        return is_string($value) && trim($value) === '';
    }
}

if (!function_exists('_is_full_string')) {
    /**
     * @deprecated since 1.0.0
     */
    function _is_full_string($value) {
        return is_string($value) && trim($value) !== '';
    }
}

if (!function_exists('pf_is_full_string')) {
    /**
     * @deprecated since 1.0.0
     */
    function pf_is_full_string($value): bool {
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

if (!function_exists('pf_minify_html')) {
    function pf_minify_html(string $html): string {
        $html = preg_replace('/^\s+[<]+/m', '<', $html);

        return $html;
    }
}

if (!function_exists('json_encode_320')) {
    function json_encode_320($value): string {
        return json_encode($value, \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE | \JSON_THROW_ON_ERROR);
    }
}

if (!function_exists('json_encode_320_pretty')) {
    function json_encode_320_pretty($value): string {
        return json_encode($value, \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE | \JSON_THROW_ON_ERROR | \JSON_PRETTY_PRINT);
    }
}

if (!function_exists('json_decode_320')) {
    function json_decode_320(string $value): array {
        return json_decode($value, true, 512, \JSON_THROW_ON_ERROR);
    }
}

if (!function_exists('mb_strpos_utf8')) {
    /**
     * @param string $haystack the string being checked
     * @param string $needle   the string to find in haystack
     *
     * @return false|int Returns the numeric position of the first occurrence of needle in the haystack string. If needle is not found, it returns false.
     */
    function mb_strpos_utf8(string $haystack, string $needle) {
        return mb_strpos($haystack, $needle, 0, 'UTF-8');
    }
}

if (!function_exists('pf_query_string')) {
    function pf_query_string(bool $with_prefix = true): string {
        if (!isset($_SERVER['QUERY_STRING'])) {
            return '';
        }

        if (pf_is_empty_string($_SERVER['QUERY_STRING'])) {
            return '';
        }

        return ($with_prefix ? '?' : '') . trim($_SERVER['QUERY_STRING']);
    }
}

if (!function_exists('pf_http_build_query_rfc3986')) {
    function pf_http_build_query_rfc3986(array $query): string {
        return http_build_query($query, '', '&', \PHP_QUERY_RFC3986);
    }
}

if (!function_exists('pf_split_string_using_rn')) {
    function pf_split_string_using_rn(string $haystack): array {
        return preg_split('/\r\n|\n|\r/', $haystack);
    }
}

if (!function_exists('pf_urlsafe_b64encode')) {
    function pf_urlsafe_b64encode(string $s): string {
        return str_replace(['+', '/', '='], ['-', '.', '_'], base64_encode($s));
    }
}

if (!function_exists('pf_urlsafe_b64decode')) {
    function pf_urlsafe_b64decode(string $s): string {
        return base64_decode(str_replace(['-', '.', '_'], ['+', '/', '='], $s));
    }
}

if (!function_exists('pf_mt_rand')) {
    function pf_mt_rand(int $min, int $max): int {
        return mt_rand($min, $max);
    }
}

if (!function_exists('pf_mt_rand_without4')) {
    function pf_mt_rand_without4(int $min, int $max): int {
        do {
            $value = mt_rand($min, $max);
        } while (str_contains((string) $value, '4'));

        return $value;
    }
}

if (!function_exists('pf_date_format')) {
    function pf_date_format(int|null $timestamp = null): string {
        if ($timestamp === null) {
            $timestamp = time();
        }

        return date('Y-m-d H:i:s', $timestamp);
    }
}

if (!function_exists('pf_posix_username')) {
    function pf_posix_username(string|null $defaultValue = null): string|null {
        if (function_exists('posix_getpwuid') && function_exists('posix_geteuid')) {
            $userinfo = posix_getpwuid(posix_geteuid());

            if (isset($userinfo['name'])) {
                return $userinfo['name'];
            }
        }

        return $defaultValue;
    }
}

if (!function_exists('pf_with_round_brackets')) {
    function pf_with_round_brackets($value, bool $is_pinyin = true): string {
        $left = $is_pinyin ? '（' : '(';
        $right = $is_pinyin ? '）' : ')';

        if (pf_is_string_filled($value) || is_int($value)) {
            return $left . $value . $right;
        }

        return '';
    }
}

if (!function_exists('pf_url2filename')) {
    function pf_url2filename(string $url, bool $keep_protocol = true): string {
        if (filter_var($url, \FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException("Invalid URL: [$url]");
        }

        $url = u($url)
            ->replace('https://', $keep_protocol ? 'https---' : '')
            ->replace('http://', $keep_protocol ? 'http---' : '')
            ->toString();

        if (!preg_match('/^[a-zA-Z0-9\-_.\/?=&#]+$/', $url)) {
            throw new InvalidArgumentException("URL contains unspecified special characters: [$url]");
        }

        return u($url)
            ->replace('/', '..S..')
            ->replace('?', '..Q..')
            ->replace('&', '..A..')
            ->replace('=', '..E..')
            ->replace('#', '..H..')
            ->toString();
    }
}

if (!function_exists('pf_filename2url')) {
    function pf_filename2url(string $filename): string {
        return u($filename)
            ->replace('https---', 'https://')
            ->replace('http---', 'http://')
            ->replace('..S..', '/')
            ->replace('..Q..', '?')
            ->replace('..A..', '&')
            ->replace('..E..', '=')
            ->replace('..H..', '#')
            ->toString();
    }
}

if (!function_exists('pf_number_format')) {
    function pf_number_format(float $number, int $decimals): string {
        return number_format($number, $decimals, '.', '');
    }
}

if (!function_exists('pf_git_last_modified_timestamp')) {
    function pf_git_last_modified_timestamp(string $repo, string $file): int|null {
        $cmd = 'git -C "' . $repo . '"   log -1 --pretty="format:%ct"     "'
            . $file
            . '"  2>&1';

        exec($cmd, $git_log_output, $git_log_result_code);

        if ($git_log_result_code === 0 && is_numeric($git_log_output[0] ?? null)) {
            return (int) $git_log_output[0];
        }

        return null;
    }
}
