<?php

declare(strict_types=1);

if (!function_exists('pf_get_full_url')) {
    function pf_get_full_url(): ?string
    {
        if (!isset($_SERVER['SERVER_NAME'])) {
            return null;
        }

        $https = false;
        if (in_array($_SERVER['HTTPS'] ?? null, ['on', 'On', 'ON', 1, '1', true, 'true', 'True', 'TRUE'], true)) {
            $https = true;
        }

        $protocol = $https ? 'https' : 'http';

        $port = '';
        if (isset($_SERVER['SERVER_PORT'])) {
            $port = ':' . $_SERVER['SERVER_PORT'];
            if ($https) {
                if (in_array($_SERVER['SERVER_PORT'], ['443', 443], true)) {
                    $port = '';
                }
            } else {
                if (in_array($_SERVER['SERVER_PORT'], ['80', 80], true)) {
                    $port = '';
                }
            }
        }

        $path = $_SERVER['REQUEST_URI'] ?? '';
        if ($path !== '') {
            if (mb_substr($path, 0, 1, 'UTF-8') !== '/') {
                $path = '/' . $path;
            }
        }

        return $protocol . '://' . $_SERVER['SERVER_NAME'] . $port . $path;
    }
}

if (!function_exists('pf_url_path_match_or_starts_with')) {
    function pf_url_path_match_or_starts_with(string $url = null): ?string
    {
        if ($url === null) {
            $url = pf_get_full_url();
        }

        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
    }
}

