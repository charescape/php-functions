<?php

declare(strict_types=1);

if (!function_exists('htmlspecialchars_utf8')) {
    function htmlspecialchars_utf8(string $str, bool $double_encode = true): string {
        return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', $double_encode);
    }
}
