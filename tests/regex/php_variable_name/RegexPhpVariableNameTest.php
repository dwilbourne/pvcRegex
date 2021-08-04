<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace tests\regex\php_variable_name;

use PHPUnit\Framework\TestCase;
use pvc\regex\php_variable_name\RegexPhpVariableName;

class RegexPhpVariableNameTest extends TestCase
{
    protected RegexPhpVariableName $regex;

    public function setUp() : void
    {
        $this->regex = new RegexPhpVariableName();
    }

    public function testBasics()
    {
        // 'letters' and numbers OK, including 0x80-0xff
        self::assertTrue($this->regex->match("ThisIsOk44" . 0xf5));
        // cannot start with a number
        self::assertFalse($this->regex->match("4ThisIsNotOk44"));
        // cannot have a symbol in the lower 64 ascii range which is not a letter or a number
        self::assertFalse($this->regex->match("ThisIsNotOk+"));
    }
}
