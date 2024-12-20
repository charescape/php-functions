<?php

declare(strict_types=1);

namespace Charescape\PhpFunctions\Tests;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase {
    public function test_pf_git_last_modified_timestamp()
    {
        $this->assertSame(1729269935, pf_git_last_modified_timestamp(
            dirname(__DIR__),
            'tests/git-do-not-modify.txt'
        ));
    }

    public function test_pf_number_format()
    {
        $this->assertSame('33.33', pf_number_format(100 / 3, 2));
        $this->assertSame('33.333', pf_number_format(100 / 3, 3));
        $this->assertSame('33', pf_number_format(100 / 3, 0));
    }

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

    public function test_pf_posix_username()
    {
        $this->assertSame('runner', pf_posix_username());
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

    public function test_pf_numeric_to_int()
    {
        $this->assertSame(0, pf_numeric_to_int('0'));
        $this->assertSame(0, pf_numeric_to_int('-0'));
        $this->assertSame(3, pf_numeric_to_int('3'));
        $this->assertSame(123, pf_numeric_to_int('123'));
        $this->assertSame(-123, pf_numeric_to_int('-123'));
        $this->assertSame('1,234', pf_numeric_to_int('1,234'));
        $this->assertSame('0123', pf_numeric_to_int('0123'));
        $this->assertSame('-0123', pf_numeric_to_int('-0123'));
        $this->assertSame('123.45', pf_numeric_to_int('123.45'));
    }

    public function test_pf_url_filename()
    {
        $urls = [
            'https://www.bing.com/search?q=php&form=QBRE&sp=-1&sc=7-15&sk=&ghpl=',
             'http://www.bing.com/search/abc/efg/xyz.html?mnid=#mnId#',
        ];
        $filenames = [
            'https---www.bing.com..S..search..Q..q..E..php..A..form..E..QBRE..A..sp..E..-1..A..sc..E..7-15..A..sk..E....A..ghpl..E..',
             'http---www.bing.com..S..search..S..abc..S..efg..S..xyz.html..Q..mnid..E....H..mnId..H..',
        ];

        foreach ($urls as $i => $url) {
            $this->assertSame($filenames[$i], pf_url2filename($url));
        }

        $this->assertSame(
            'www.bing.com..S..search..S..abc..S..efg..S..xyz.html..Q..mnid..E....H..mnId..H..',
            pf_url2filename('http://www.bing.com/search/abc/efg/xyz.html?mnid=#mnId#', false)
        );

        foreach ($filenames as $i => $filename) {
            $this->assertSame($urls[$i], pf_filename2url($filename));
            $this->assertSame(7, file_put_contents(sys_get_temp_dir() . "/$filename", "test123", LOCK_EX));
        }
    }
}
