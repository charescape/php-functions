<?php

declare(strict_types=1);

namespace Charescape\PhpFunctions\Tests;

use PHPUnit\Framework\TestCase;

class InternalTest extends TestCase {
    public function test_htmlspecialchars_utf8()
    {
        $this->assertSame('&quot;', htmlspecialchars_utf8('"'));
        $this->assertSame('&lt;', htmlspecialchars_utf8('<'));
        $this->assertSame('&gt;', htmlspecialchars_utf8('>'));
        $this->assertSame('&amp;', htmlspecialchars_utf8('&'));
        $this->assertSame('&amp;amp;', htmlspecialchars_utf8('&amp;'));
        $this->assertSame('&amp;', htmlspecialchars_utf8('&amp;', false));
    }
}
