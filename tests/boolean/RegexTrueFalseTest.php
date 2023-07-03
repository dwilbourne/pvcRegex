<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvcTests\regex\boolean;

use PHPUnit\Framework\TestCase;
use pvc\regex\boolean\RegexTrueFalse;

/**
 * Class RegexTrueFalseTest
 */
class RegexTrueFalseTest extends TestCase
{

    public function setUp(): void
    {
        $this->regex = new RegexTrueFalse();
        $this->regex->setCaseSensitive(false);
    }

    /**
     * testPattern
     * @param string $testString
     * @param bool $expectedResult
     * @dataProvider dataProvider
     * @covers \pvc\regex\boolean\RegexTrueFalse::__construct
     */
    public function testPattern(string $testString, bool $expectedResult) : void
    {
        $this->assertEquals($expectedResult, $this->regex->match($testString));
    }

    /**
     * dataProvider
     * @return array
     */
    public function dataProvider() : array
    {
        return [
            'lower case true - OK' => ['true', true],
            'upper case true - OK' => ['TRUE', true],
            'mixed case true - OK' => ['TrUe', true],
            'lower case false - OK' => ['false', true],
            'upper case false - OK' => ['FALSE', true],
            'mixed case false - OK' => ['fAlSe', true],
            'some other string - not OK' => ['some string', false],
            'some string containing true - not OK' => ['some true string', false],
            'empty string not ok' => ['', false]
        ];
    }
}
