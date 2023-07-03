<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvcTests\regex\boolean;

use PHPUnit\Framework\TestCase;
use pvc\regex\boolean\RegexYesNo;

class RegexYesNoTest extends TestCase
{
    protected RegexYesNo $regex;

    /**
     * setUp
     */
    public function setUp() : void
    {
        $this->regex = new RegexYesNo();
        $this->regex->setCaseSensitive(false);
    }

    /**
     * testPattern
     * @param string $testString
     * @param bool $expectedResult
     * @dataProvider dataProvider
     * @covers \pvc\regex\boolean\RegexYesNo::__construct
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
            'lower case yes - OK' => ['yes', true],
            'upper case yes - OK' => ['YES', true],
            'mixed case yes - OK' => ['yEs', true],
            'lower case no - OK' => ['no', true],
            'upper case no - OK' => ['NO', true],
            'mixed case no - OK' => ['nO', true],
            'some other string - not ok' => ['some string', false],
            'some string containing no - not OK' => ['nothing', false],
            'empty string not ok' => ['', false]
        ];
    }
}
