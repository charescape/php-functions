<?php

declare(strict_types=1);

namespace Charescape\PhpFunctions\Tests;

use PHPUnit\Framework\TestCase;

class IntegrationsTest extends TestCase {
    public function test_pf_gfm(): void
    {
        $this->assertSame('<h1>Hello World!</h1>', pf_gfm()->convert('# Hello World!'));
    }
}
