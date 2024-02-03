<?php

declare(strict_types=1);

namespace Charescape\PhpFunctions\Tests;

use PHPUnit\Framework\TestCase;

class InternalTest extends TestCase {
    public function test_htmlspecialchars_utf8()
    {
        $this->assertSame('abc', htmlspecialchars_utf8('abc'));
        $this->assertSame('&quot;', htmlspecialchars_utf8('"'));
        $this->assertSame('&lt;', htmlspecialchars_utf8('<'));
        $this->assertSame('&gt;', htmlspecialchars_utf8('>'));
        $this->assertSame('&amp;', htmlspecialchars_utf8('&'));
        $this->assertSame('&amp;amp;', htmlspecialchars_utf8('&amp;'));
        $this->assertSame('&amp;', htmlspecialchars_utf8('&amp;', false));
    }

    public function test_htmlspecialchars_utf8_mixed()
    {
        $this->assertSame('abc', htmlspecialchars_utf8_mixed('abc'));
        $this->assertSame('&quot;', htmlspecialchars_utf8_mixed('"'));
        $this->assertSame('&lt;', htmlspecialchars_utf8_mixed('<'));
        $this->assertSame('&gt;', htmlspecialchars_utf8_mixed('>'));
        $this->assertSame('&amp;', htmlspecialchars_utf8_mixed('&'));
        $this->assertSame('&amp;amp;', htmlspecialchars_utf8_mixed('&amp;'));
        $this->assertSame('&amp;', htmlspecialchars_utf8_mixed('&amp;', false));

        $this->assertSame('true', htmlspecialchars_utf8_mixed(true));
        $this->assertSame('false', htmlspecialchars_utf8_mixed(false));
        $this->assertSame('null', htmlspecialchars_utf8_mixed(null));
        $this->assertSame('123', htmlspecialchars_utf8_mixed(123));
        $this->assertSame('1.23', htmlspecialchars_utf8_mixed(1.23));
    }
}
