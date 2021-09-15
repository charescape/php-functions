<?php

declare(strict_types=1);

namespace Charescape\PhpFunctions\Tests;

use PHPUnit\Framework\TestCase;

class IsTest extends TestCase {
    public function test_pf_is_string_filled()
    {
        $this->assertTrue(pf_is_string_filled('abc'));
        $this->assertTrue(pf_is_string_filled('123'));

        $this->assertFalse(pf_is_string_filled(''));
        $this->assertFalse(pf_is_string_filled(' '));
        $this->assertFalse(pf_is_string_filled(0));
        $this->assertFalse(pf_is_string_filled(123));
        $this->assertFalse(pf_is_string_filled(123.45));
        $this->assertFalse(pf_is_string_filled(true));
        $this->assertFalse(pf_is_string_filled(false));

        $this->assertFalse(pf_is_string_filled(null));
        $this->assertFalse(pf_is_string_filled([]));
        $this->assertFalse(pf_is_string_filled((object)[]));


        $this->assertTrue(pf_is_string_filled('abc', true));
        $this->assertTrue(pf_is_string_filled('123', true));

        $this->assertFalse(pf_is_string_filled('', true));
        $this->assertFalse(pf_is_string_filled(' ', true));
        $this->assertTrue(pf_is_string_filled(0, true));
        $this->assertTrue(pf_is_string_filled(123, true));
        $this->assertTrue(pf_is_string_filled(123.45, true));
        $this->assertFalse(pf_is_string_filled(true, true));
        $this->assertFalse(pf_is_string_filled(false, true));

        $this->assertFalse(pf_is_string_filled(null, true));
        $this->assertFalse(pf_is_string_filled([], true));
        $this->assertFalse(pf_is_string_filled((object)[], true));
    }

    public function test_pf_is_string_empty()
    {
        $this->assertFalse(pf_is_string_empty('abc'));
        $this->assertFalse(pf_is_string_empty('123'));

        $this->assertTrue(pf_is_string_empty(''));
        $this->assertTrue(pf_is_string_empty(' '));
        $this->assertFalse(pf_is_string_empty(0));
        $this->assertFalse(pf_is_string_empty(123));
        $this->assertFalse(pf_is_string_empty(123.45));
        $this->assertFalse(pf_is_string_empty(true));
        $this->assertFalse(pf_is_string_empty(false));

        $this->assertFalse(pf_is_string_empty(null));
        $this->assertFalse(pf_is_string_empty([]));
        $this->assertFalse(pf_is_string_empty((object)[]));
    }
}
