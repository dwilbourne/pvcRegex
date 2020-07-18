<?php
namespace tests\regex;

use PHPUnit\Framework\TestCase;
use pvc\msg\Msg;
use pvc\regex\err\RegexBadPatternException;
use pvc\regex\err\RegexInvalidMatchIndexException;
use pvc\regex\err\RegexPatternUnsetException;
use pvc\regex\err\RegexSanitizeCharException;
use pvc\regex\Regex;

class RegexTest extends TestCase
{

    protected Regex $regex;

    public function setUp(): void
    {
        $this->regex = new Regex();
    }

    public function testSetValidateGetPattern() : void
    {
        self::assertNull($this->regex->getPattern());

        $pattern = '/foo/';
        $this->regex->setPattern($pattern);
        self::assertSame($pattern, $this->regex->getPattern());

        $pattern = '{morn/';
        $this->expectException(RegexBadPatternException::class);
        $this->regex->setPattern($pattern);
    }

    public function testValidatePattern() : void
    {
        $pattern = '{morn/';
        self::assertFalse($this->regex->validatePattern($pattern));
        self::assertInstanceOf(Msg::class, $this->regex->getErrmsg());

        $pattern = '';
        self::assertFalse($this->regex->validatePattern($pattern));
        self::assertInstanceOf(Msg::class, $this->regex->getErrmsg());

        $pattern = '/(\.php)$/';
        self::assertTrue($this->regex->validatePattern($pattern));
    }

    public function testSetGetLabel() : void
    {
        self::assertNull($this->regex->getLabel());
        $label = 'valid xml element name';
        $this->regex->setLabel($label);
        self::assertSame($label, $this->regex->getLabel());
    }

    public function testMatch() : void
    {
        $subject = 'foo';
        $pattern = '/' . $subject . '/';
        $this->regex->setPattern($pattern);
        $this->regex->match($subject);
        self::assertTrue($this->regex->match($subject));
        self::assertFalse($this->regex->match('/baz/'));
        self::assertInstanceOf(Msg::class, $this->regex->getErrmsg());
    }

    public function testMatchUnsetPatternException() : void
    {
        $subject = 'foo';
        self::expectException(RegexPatternUnsetException::class);
        $this->regex->match($subject);
    }

    public function testCreateErrmsg() : void
    {
        $label = 'valid xml element name';
        $this->regex->setLabel($label);
        $expectedResult = new Msg([$label], 'Input must be a %s.');
        $actualResult = $this->regex->createErrmsg();
        self::assertEquals($expectedResult->getMsgVars(), $actualResult->getMsgVars());
        self::assertEquals($expectedResult->getMsgText(), $actualResult->getMsgText());
    }

    public function testGetMatchExceptionBadIndex() : void
    {
        $subject = 'foo';
        $pattern = '/bar/';
        $this->regex->setPattern($pattern);
        self::assertFalse($this->regex->match($subject));
        $this->expectException(RegexInvalidMatchIndexException::class);
        $match = $this->regex->getMatch('baz');
    }

    public function testMatchCapturing() : void
    {
        $subject = 'foobarbaz';
        $pattern = '/(foo)(bar)(baz)/';
        $this->regex->setPattern($pattern);
        self::assertTrue($this->regex->match($subject));
        $matches = $this->regex->getMatches();

        self::assertSame($subject, $matches[0]);
        self::assertSame('foo', $matches[1]);
        self::assertSame('bar', $matches[2]);
        self::assertSame('baz', $matches[3]);
    }

    public function testEscapeMetaCharacters() : void
    {
        $inCharacterClass = false;
        self::assertEquals('\.', Regex::escapeChar('.', $inCharacterClass));
        self::assertEquals('\^', Regex::escapeChar('^', $inCharacterClass));
        self::assertEquals('\$', Regex::escapeChar('$', $inCharacterClass));
        self::assertEquals('a', Regex::escapeChar('a', $inCharacterClass));
    }

    public function testEscapeCharException() : void
    {
        $testStringWithMoreThanOneCharacter = 'goo';
        self::expectException(RegexSanitizeCharException::class);
        $this->regex::escapeChar($testStringWithMoreThanOneCharacter);
    }

    public function testEscapeCharacterClassMetaCharacters() : void
    {
        $inCharacterClass = true;
        self::assertEquals('\.', Regex::escapeChar('.', $inCharacterClass));
        self::assertEquals('\^', Regex::escapeChar('^', $inCharacterClass));
        self::assertEquals('$', Regex::escapeChar('$', $inCharacterClass));
        self::assertEquals('a', Regex::escapeChar('a', $inCharacterClass));
    }

    public function testEscapeString() : void
    {
        $inCharacterClass = false;
        $string = 'This is one sentence with a carat ^ and a period. And this is one with a $ and a period.';
        $expectedResult = '';
        $expectedResult .= 'This is one sentence with a carat \^ and a period\. ';
        $expectedResult .= 'And this is one with a \$ and a period\.';
        self::assertEquals($expectedResult, $this->regex::escapeString($string, $inCharacterClass));
        $inCharacterClass = true;
        // $ is not a meta character in a character class
        $expectedResult = 'This is one sentence with a carat \^ and a period\. And this is one with a $ and a period\.';
        self::assertEquals($expectedResult, $this->regex::escapeString($string, $inCharacterClass));
    }

    public function testValidateDelimiter() : void
    {
        self::assertTrue($this->regex->validateDelimiter('/'));
        self::assertTrue($this->regex->validateDelimiter('@'));
        self::assertFalse($this->regex->validateDelimiter('a'));
        self::assertFalse($this->regex->validateDelimiter('9'));
        self::assertFalse($this->regex->validateDelimiter(' '));
        self::assertFalse($this->regex->validateDelimiter('\\'));
    }


    public function testNamedSubpatternRegex() : void
    {
        $pattern = "/^(?'leadingDigits'[1-9]\d{0,2}),((?'nextDigits'\d{3}),)*(?'finalDigits'\d{3})$/";
        $this->regex->setPattern($pattern);
        $subject = '12,345,678,901,234';
        self::assertTrue($this->regex->match($subject));

        self::assertEquals('12', $this->regex->getMatch('leadingDigits'));
        // this fails - nextDigits consists only of the last piece of the subject which matches the subpattern,
        // e.g. nextDigits = '901'
        self::assertNotEquals('345678901', $this->regex->getMatch('nextDigits'));
        self::assertEquals('234', $this->regex->getMatch('finalDigits'));
    }

    public function testMatchVersusMatchAll() : void
    {
        $pattern = '/\+/';
        $this->regex->setPattern($pattern);
        $subject = '1+2+3+4+5';
        self::assertTrue($this->regex->match($subject));
        self::assertEquals(1, count($this->regex->getMatches()));

        $matchAll = true;
        self::assertTrue($this->regex->match($subject, $matchAll));
        // preg_match_all returns an array of arrays
        // in this instance, the matches are stored in the first element of the matches array
        $matches = $this->regex->getMatch(0);
        $matches = (array) $matches ?: [];
        self::assertEquals(4, count($matches));
    }
}
