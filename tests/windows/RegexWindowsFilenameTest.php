<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types=1);

namespace pvcTests\regex\windows;

use PHPUnit\Framework\TestCase;
use pvc\regex\windows\RegexWindowsFilename;
use pvc\testingutils\testingTraits\RandomStringGeneratorTrait;

/**
 * Class RegexAlphabeticTest
 */
class RegexWindowsFilenameTest extends TestCase
{

    use RandomStringGeneratorTrait;

    /**
     * @function testIllegalChars
     * @param string $subject
     * @param bool $allowFileExtension
     * @param bool $expectedResult
     * @dataProvider dataProviderIllegalChars
     * @covers \pvc\regex\windows\RegexWindowsFilename::__construct
     * @covers \pvc\regex\windows\RegexWindowsFilename::getIllegalChars
     */

    public function testIllegalChars(string $subject, bool $allowFileExtension, bool $expectedResult) : void
    {
        $regex = new RegexWindowsFilename($allowFileExtension);
        self::assertEquals($expectedResult, $regex->match($subject));
    }

    public function dataProviderIllegalChars() : array
    {
        return [
            'base case - all legals chars including period' => ['abc.txt', true, true],
            'less than sign' => ['a<c', true, false],
            'greater than sign' => ['a>c', true, false],
            'colon' => ['a:c', true, false],
            'doublequote' => ['a"c', true, false],
            'backslash' => ['a\\c', true, false],
            'frontslash' => ['a/c', true, false],
            'pipe' => ['a|c', true, false],
            'question mark' => ['a?c', true, false],
            'asterisk' => ['a*c', true, false],
            'multiple periods should be OK' => ['test..txt', true, true],
            'unless no periods are allowed' => ['test.txt', false, false],
        ];
    }

    /**
     * @function testIllegalFilenames
     * @param string $subject
     * @param bool $expectedResult
     * @dataProvider dataProviderIllegalFilenames
     * @covers \pvc\regex\windows\RegexWindowsFilename::__construct
     * @covers \pvc\regex\windows\RegexWindowsFilename::getIllegalFilenames
     */
    public function testIllegalFilenames(string $subject, bool $expectedResult) : void
    {
        $allowFileExtension = true;
        $regex = new RegexWindowsFilename($allowFileExtension);
        static::assertEquals($expectedResult, $regex->match($subject));
    }

    /**
     * dataProviderIllegalFilenames
     */
    public function dataProviderIllegalFilenames() : array
    {
        return [
            'base case - all legals chars (ABC)' => ['ABC', true],
            'CON' => ['CON', false],
            'Con (case insensitive)' => ['Con', false],
            'PRN' => ['PRN', false],
            'AUX' => ['AUX', false],
            'NUL' => ['NUL', false],
            'COM1' => ['COM1', false],
            'COM9' => ['COM9', false],
            'COM10' => ['COM10', true],
            'LPT1' => ['LPT1', false],
            'LPT9' => ['LPT9', false],
            'LPT10' => ['LPT10', true],
            'LPT10.txt' => ['LPT1.txt', true],
        ];
    }

    /**
     * testMaxFilenameLength
     * @covers \pvc\regex\windows\RegexWindowsFilename::__construct
     */
    public function testMaxFilenameLength() : void
    {
        $allowFileExtension = true;
        $regex = new RegexWindowsFilename($allowFileExtension);
        $length = 257;
        $badFileName = $this->randomString($length);
        self::assertFalse($regex->match($badFileName));
    }
}
