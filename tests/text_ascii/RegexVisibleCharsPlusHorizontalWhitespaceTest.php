<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

declare(strict_types=1);

namespace pvcTests\regex\text_ascii;

use PHPUnit\Framework\TestCase;
use pvc\regex\text_ascii\RegexVisibleCharsPlusHorizontalWhitespace;

class RegexVisibleCharsPlusHorizontalWhitespaceTest extends TestCase
{
    protected RegexVisibleCharsPlusHorizontalWhitespace $regex;

    public function setUp(): void
    {
        $this->regex = new RegexVisibleCharsPlusHorizontalWhitespace();
    }

    /**
     * @function testPattern
     * @param string $subject
     * @param bool $expectedResult
     * @dataProvider dataProvider
     * @covers \pvc\regex\text_ascii\RegexVisibleCharsPlusHorizontalWhitespace::__construct
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
            'special marks, punctuation etc ok' => ['~`@#$%^&*()_-+={[}]<,>.?/)', true],
            'horizontal whitespace OK (spaces, tabs)' => [chr(040) . '96Hfu3' . chr(011), true],
            'vertical whitespace no good (form feed)' => ['hiH' . chr(12) . 'GGF', false],
            'Start of header (SOH) no good' => ['hiH' . chr(1) . 'GGF', false],
        ];
    }
}
