<?php

namespace pvcTests\regex\numeric;

use PHPUnit\Framework\TestCase;
use pvc\regex\numeric\RegexDecimalSimple;

class RegexDecimalSimpleTest extends TestCase
{
    protected RegexDecimalSimple $regex;

    public function setUp(): void
    {
        $this->regex = new RegexDecimalSimple();
    }

    /**
     * @function testPattern
     *
     * @param  string  $subject
     * @param  bool  $expectedResult
     *
     * @dataProvider dataProvider
     * @covers       \pvc\regex\numeric\RegexIntegerSimple::__construct
     */

    public function testPattern(string $subject, bool $expectedResult): void
    {
        static::assertEquals($expectedResult, $this->regex->match($subject));
    }

    public function dataProvider(): array
    {
        return [
            'positive integer'                => ['12345', true],
            'zero'                            => ['0', true],
            'multiple zeros'                  => ['0000', false],
            'negative integer'                => ['-4321', true],
            'decimal point no suffix is OK'   => ['45.', true],
            'decimal point with suffix is OK' => ['45.37683', true],
            'two decimal points no good'      => ['45.123.56', false],
            'alphanumeric no good'            => ['a576', false]
        ];
    }

}
