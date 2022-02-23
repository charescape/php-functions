<?php

declare(strict_types=1);

namespace Charescape\PhpFunctions\Tests;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase {
    public function test_pf_date_format()
    {
        $timestamp = time();

        $this->assertTrue(strtotime(pf_date_format()) >= time());
        $this->assertTrue(strtotime(pf_date_format()) <= (time() + 1));
        $this->assertSame(date('Y-m-d H:i:s', $timestamp), pf_date_format($timestamp));
        $this->assertSame(date('Y-m-d H:i:s', $timestamp + 3600), pf_date_format($timestamp + 3600));
    }
}
