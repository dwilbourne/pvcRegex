<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvcTests\regex\numeric;

use PHPUnit\Framework\TestCase;
use pvc\regex\numeric\RegexIntegerSimple;

class RegexIntegerSimpleTest extends TestCase
{
    protected RegexIntegerSimple $regex;

    public function setUp() : void
    {
        $this->regex = new RegexIntegerSimple();
    }

    /**
     * @function testPattern
     * @param string $subject
     * @param bool $expectedResult
     * @dataProvider dataProvider
     * @covers \pvc\regex\numeric\RegexIntegerSimple::__construct
     */

    public function testPattern(string $subject, bool $expectedResult) : void
    {
        static::assertEquals($expectedResult, $this->regex->match($subject));
    }

    public function dataProvider() : array
    {
        return [
            'positive integer' => ['12345', true],
            'zero' => ['0', true],
            'multiple zeros' => ['0000', false],
            'negative integer' => ['-4321', true],
            'decimal point no good' => ['45.0', false],
            'alphanumeric no good' => ['a576', false]
        ];
    }
}
