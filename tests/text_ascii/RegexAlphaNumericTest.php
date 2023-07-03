<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

declare(strict_types=1);

namespace pvcTests\regex\text_ascii;

use PHPUnit\Framework\TestCase;
use pvc\regex\text_ascii\RegexAlphaNumeric;

/**
 * Class RegexAlphabeticTest
 */
class RegexAlphaNumericTest extends TestCase
{

    protected RegexAlphaNumeric $regex;

    public function setUp(): void
    {
        $this->regex = new RegexAlphaNumeric();
    }

    /**
     * @function testPattern
     * @param string $subject
     * @param bool $expectedResult
     * @dataProvider dataProvider
     * @covers \pvc\regex\text_ascii\RegexAlphaNumeric::__construct
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
            'numbers OK' => ['UhUhio873HYjl', true],
            'only numbers OK' => ['18793648379', true],
            'punctuation no good' => ['UhgIhhiHGGF&*%)', false],
            'whitespace no good' => ['  hiHGGF&*%)', false],
        ];
    }
}
