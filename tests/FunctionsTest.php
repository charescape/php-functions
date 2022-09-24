<?php

declare(strict_types=1);

namespace Charescape\PhpFunctions\Tests;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase {
    public function test_pf_mt_rand_without4()
    {
        $this->assertIsInt(pf_mt_rand_without4(100000, 999999));

        for ($i = 0; $i < 20; $i++) {
            $this->assertStringNotContainsString('4', (string) pf_mt_rand_without4(100000, 999999));
        }
    }

    public function test_pf_date_format()
    {
        $timestamp = time();

        $this->assertTrue(strtotime(pf_date_format()) >= time());
        $this->assertTrue(strtotime(pf_date_format()) <= (time() + 1));
        $this->assertSame(date('Y-m-d H:i:s', $timestamp), pf_date_format($timestamp));
        $this->assertSame(date('Y-m-d H:i:s', $timestamp + 3600), pf_date_format($timestamp + 3600));
    }

    public function test_pf_with_round_brackets()
    {
        $this->assertSame('（你好）', pf_with_round_brackets('你好'));
        $this->assertSame('(你好)', pf_with_round_brackets('你好', false));
        $this->assertSame('（0）', pf_with_round_brackets(0));
        $this->assertSame('(0)', pf_with_round_brackets(0, false));
        $this->assertSame('（123）', pf_with_round_brackets(123));
        $this->assertSame('(123)', pf_with_round_brackets(123, false));
        $this->assertSame('', pf_with_round_brackets(''));
        $this->assertSame('', pf_with_round_brackets('', false));

        $this->assertSame('', pf_with_round_brackets(false));
        $this->assertSame('', pf_with_round_brackets(true));
        $this->assertSame('', pf_with_round_brackets(null));
        $this->assertSame('', pf_with_round_brackets([]));
        $this->assertSame('', pf_with_round_brackets(['a', 'b', 'c']));
    }

    public function test_pf_url_filename()
    {
        $urls = [
            'https://www.bing.com/search?q=php&form=QBRE&sp=-1&sc=7-15&sk=&ghpl=',
        ];
        $filenames = [
            'https---www.bing.com))search@@q=php&form=QBRE&sp=-1&sc=7-15&sk=&ghpl=',
        ];

        foreach ($urls as $i => $url) {
            $this->assertSame($filenames[$i], pf_url2filename($url));
        }

        foreach ($filenames as $i => $filename) {
            $this->assertSame($urls[$i], pf_filename2url($filename));
            $this->assertSame(5, file_put_contents(sys_get_temp_dir() . "/$filename", "test123", LOCK_EX));
        }
    }
}
