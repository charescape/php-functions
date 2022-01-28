<?php

declare(strict_types=1);

namespace Charescape\PhpFunctions\Tests;

use PHPUnit\Framework\TestCase;

class TypecastTest extends TestCase {
    public function test_pf_str_or_null()
    {
        $this->assertSame('abc', pf_str_or_null('abc'));
        $this->assertSame('abc', pf_str_or_null('abc '));
        $this->assertSame('abc', pf_str_or_null(' abc'));
        $this->assertSame('abc', pf_str_or_null(' abc '));
        $this->assertNull(pf_str_or_null(''));
        $this->assertNull(pf_str_or_null(' '));

        $this->assertSame('0', pf_str_or_null(0));
        $this->assertSame('123', pf_str_or_null(123));
        $this->assertSame('123.45', pf_str_or_null(123.45));
        $this->assertNull(pf_str_or_null(true));
        $this->assertNull(pf_str_or_null(false));


        $this->assertSame('abc', pf_str_or_null('abc', false));
        $this->assertSame('abc', pf_str_or_null('abc ', false));
        $this->assertSame('abc', pf_str_or_null(' abc', false));
        $this->assertSame('abc', pf_str_or_null(' abc ', false));
        $this->assertSame('', pf_str_or_null('', false));
        $this->assertSame('', pf_str_or_null(' ', false));

        $this->assertSame('abc', pf_str_or_null('abc', false, false));
        $this->assertSame('abc', pf_str_or_null('abc ', false, false));
        $this->assertSame('abc', pf_str_or_null(' abc', false, false));
        $this->assertSame('abc', pf_str_or_null(' abc ', false, false));
        $this->assertSame('', pf_str_or_null('', false, false));
        $this->assertSame(' ', pf_str_or_null(' ', false, false));
    }

}
