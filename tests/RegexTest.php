<?php

namespace pvcTests\regex;

use PHPUnit\Framework\TestCase;
use pvc\regex\err\RegexBadPatternException;
use pvc\regex\err\RegexInvalidDelimiterException;
use pvc\regex\err\RegexInvalidMatchIndexException;
use pvc\regex\Regex;

/**
 * Class RegexTest
 */
class RegexTest extends TestCase
{
    protected string $label;

    public function setUp(): void
    {
        $this->label = 'test pattern';
    }

    /**
     * testGetPatternReturnsThePatternWhichWasSet
     * @covers \pvc\regex\Regex::__construct
     * @covers \pvc\regex\Regex::setPattern
     * @covers \pvc\regex\Regex::getPattern
     */
    public function testGetPatternReturnsThePatternWhichWasSet(): void
    {
        $pattern = '/foo/';
        $regex = new Regex($pattern, $this->label);
        $msg = 'getPattern did not return the same value that was set immediately prior to its being called.';
        self::assertSame($pattern, $regex->getPattern(), $msg);
    }

    /**
     * testGetLabelReturnsLabelWhichWasSet
     * @covers \pvc\regex\Regex::setLabel
     * @covers \pvc\regex\Regex::getLabel
     */
    public function testGetLabelReturnsLabelWhichWasSet(): void
    {
        $pattern = '/foo/';
        $regex = new Regex($pattern, $this->label);
        $msg = 'getLabel did not return the same value that was set immediately prior to its being called.';
        self::assertSame($this->label, $regex->getLabel(), $msg);
    }

    /**
     * testValidatePatternReturnsFalseForBadRegex
     * @covers \pvc\regex\Regex::validatePattern
     */
    public function testValidatePatternReturnsFalseForBadRegex(): void
    {
        $pattern = '{morn/';
        $msg = 'validatePattern failed to assert $patternWithDelimiters is not a valid regex.';
        self::assertFalse(Regex::validatePattern($pattern), $msg);
    }

    /**
     * testValidatePatternReturnsTrueForGoodRegex
     * @covers \pvc\regex\Regex::validatePattern
     */
    public function testValidatePatternReturnsTrueForGoodRegex(): void
    {
        $pattern = '/(\.php)$/';
        $msg = 'failed to assert $patternWithDelimiters is a valid regex patternWithDelimiters.';
        $regex = new Regex($pattern, $this->label);
        self::assertTrue($regex->validatePattern($pattern), $msg);
    }

    /**
     * testValidatePatternReturnsFalseForEmptyStringAsPattern
     * @covers \pvc\regex\Regex::validatePattern
     */
    public function testValidatePatternReturnsFalseForEmptyStringAsPattern(): void
    {
        $pattern = '';
        $msg = 'failed to assert emptry string is not a valid regular expression.';
        self::assertFalse(Regex::validatePattern($pattern), $msg);
    }

    /**
     * testSetPatternThrowsBadPatternExceptionWithBadPattern
     * @throws RegexBadPatternException
     * @covers \pvc\regex\Regex::setPattern
     */
    public function testSetPatternThrowsBadPatternExceptionWithBadPattern(): void
    {
        $pattern = '/(\.php)$/';
        $regex = new Regex($pattern, $this->label);

        $badPattern = '{morn/';
        self::expectException(RegexBadPatternException::class);
        $regex->setPattern($badPattern);
    }

    public function validateDelimiterDataProvider(): array
    {
        return [
            '/' => ['/', true],
            '@' => ['@', true],
            'letter' => ['1', false],
            'number' => ['9', false],
            'space' => [' ', false],
            'backslash' => ['\\', false],
        ];
    }

    /**
     * testValidateDelimiter
     * @dataProvider validateDelimiterDataProvider
     * @covers \pvc\regex\Regex::validateDelimiter
     */
    public function testValidateDelimiter(string $delimiter, bool $expectedResult): void
    {
        $expectedResultText = $expectedResult ? 'true' : 'false';
        $msg = 'failed to assert that validateDelimiter returns $expectedResultText with argument $delimiter.';
        self::assertEquals($expectedResult, Regex::validateDelimiter($delimiter), $msg);
    }

    /**
     * testEscapeStringThrowsExceptionWhenInvalidDelimiterIsSupplied
     * @throws RegexInvalidDelimiterException
     * @covers \pvc\regex\Regex::escapeString
     */
    public function testEscapeStringThrowsExceptionWhenInvalidDelimiterIsSupplied(): void
    {
        $pattern = '[aeiou]';
        /** backslash is not a valid delimiter */
        $delimiter = '\\';
        $this->expectException(RegexInvalidDelimiterException::class);
        Regex::escapeString($pattern, $delimiter);
    }

    /**
     * testEscapeString
     * @throws RegexInvalidDelimiterException
     * @covers \pvc\regex\Regex::escapeString
     */
    public function testEscapeString(): void
    {
        $string = '';
        $string .= 'This is one sentence with a carat ^ and a period. ';
        $string .= 'And this is one with a dollar sign $ and a front slash /';

        $delimiter = '/';

        $expectedResult = '';
        $expectedResult .= 'This is one sentence with a carat \^ and a period\. ';
        $expectedResult .= 'And this is one with a dollar sign \$ and a front slash \/';

        $msg = 'failed to properly escape test string for use as a regex patternWithDelimiters with delimiter = /.';
        self::assertEquals($expectedResult, Regex::escapeString($string, $delimiter), $msg);
    }

    /**
     * testSetGetCaseSensitive
     * @covers \pvc\regex\Regex::setCaseSensitive
     * @covers \pvc\regex\Regex::isCaseSensitive
     */
    public function testSetGetCaseSensitive(): void
    {
        $pattern = '/foo/';
        $regex = new Regex($pattern, $this->label);

        self::assertTrue($regex->isCaseSensitive());

        $regex->setCaseSensitive(false);
        self::assertFalse($regex->isCaseSensitive());
    }

    /**
     * testMatch
     * @covers \pvc\regex\Regex::match
     */
    public function testMatch(): void
    {
        $pattern = '/foo/';
        $matchingSubject = 'foo';
        $nonMatchingSubject = 'baz';

        $regex = new Regex($pattern, $this->label);

        self::assertTrue($regex->match($matchingSubject));
        self::assertFalse($regex->match($nonMatchingSubject));
    }

    /**
     * testMatchCaseSensitive
     * @covers \pvc\regex\Regex::match
     */
    public function testMatchCaseInsensitive(): void
    {
        $pattern = '/foo/';
        $subject = 'Foo';

        $regex = new Regex($pattern, $this->label);

        $regex->setCaseSensitive(true);
        self::assertFalse($regex->match($subject));

        $regex->setCaseSensitive(false);
        self::assertTrue($regex->match($subject));
    }

    /**
     * testGetMatchExceptionBadIndex
     * @throws RegexInvalidMatchIndexException
     * @covers \pvc\regex\Regex::getMatch
     */
    public function testGetMatchExceptionBadIndex(): void
    {
        $subject = 'foo';
        $pattern = '/bar/';
        $regex = new Regex($pattern, $this->label);

        self::assertFalse($regex->match($subject));
        $this->expectException(RegexInvalidMatchIndexException::class);
        $match = $regex->getMatch('baz');
    }

    /**
     * testMatchCapturing
     * @covers \pvc\regex\Regex::getMatches
     */
    public function testMatchCapturing(): void
    {
        $subject = 'foobarbaz';
        $pattern = '/(foo)(bar)(baz)/';
        $regex = new Regex($pattern, $this->label);

        self::assertTrue($regex->match($subject));
        $matches = $regex->getMatches();

        self::assertSame($subject, $matches[0]);
        self::assertSame('foo', $matches[1]);
        self::assertSame('bar', $matches[2]);
        self::assertSame('baz', $matches[3]);
    }


    /**
     * testNamedSubpatternRegex
     * @throws RegexInvalidMatchIndexException
     * @covers \pvc\regex\Regex::getMatch
     */
    public function testNamedSubpatternRegex(): void
    {
        $pattern = "/^(?'leadingDigits'[1-9]\d{0,2}),((?'nextDigits'\d{3}),)*(?'finalDigits'\d{3})$/";
        $regex = new Regex($pattern, $this->label);

        $subject = '12,345,678,901,234';
        self::assertTrue($regex->match($subject));

        self::assertEquals('12', $regex->getMatch('leadingDigits'));
        // this fails - nextDigits consists only of the last piece of the subject which matches the subpattern,
        // e.g. nextDigits = '901'
        self::assertNotEquals('345678901', $regex->getMatch('nextDigits'));
        self::assertEquals('234', $regex->getMatch('finalDigits'));
    }

    /**
     * testMatchVersusMatchAll
     * @covers \pvc\regex\Regex::match
     */
    public function testMatchVersusMatchAll(): void
    {
        $pattern = '/\+/';
        $regex = new Regex($pattern, $this->label);

        $subject = '1+2+3+4+5';
        self::assertTrue($regex->match($subject));
        self::assertEquals(1, count($regex->getMatches()));

        $matchAll = true;
        self::assertTrue($regex->match($subject, $matchAll));
        // preg_match_all returns an array of arrays
        // in this instance, the matches are stored in the first element of the matches array
        $matches = $regex->getMatch(0);
        $matches = (array) $matches ?: [];
        self::assertEquals(4, count($matches));
    }
}
