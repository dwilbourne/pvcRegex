<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

declare(strict_types=1);

namespace pvcTests\regex\text_ascii;

use PHPUnit\Framework\TestCase;
use pvc\regex\text_ascii\RegexAlphabetic;

/**
 * Class RegexAlphabeticTest
 */
class RegexAlphabeticTest extends TestCase
{

    protected RegexAlphabetic $regex;

    public function setUp(): void
    {
        $this->regex = new RegexAlphabetic();
    }

    /**
     * @function testPattern
     * @param string $subject
     * @param bool $expectedResult
     * @dataProvider dataProvider
     * @covers \pvc\regex\text_ascii\RegexAlphabetic::__construct
     */

    public function testPattern(string $subject, bool $expectedResult) : void
    {
        static::assertEquals($expectedResult, $this->regex->match($subject));
    }

    public function dataProvider() : array
    {
        return [
            'lower case' => ['assgogdf', true],
            'upper case' => ['EUIRYOIUY', true],
            'mixed case' => ['UhRfTlkOP', true],
            'numbers no good' => ['UhUhio873HYjl', false],
            'punctuation no good' => ['UhgIhhiHGGF&*%)', false]
        ];
    }
}
