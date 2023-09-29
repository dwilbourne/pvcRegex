<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */
declare (strict_types=1);

namespace pvcTests\regex\filename;

use PHPUnit\Framework\TestCase;
use pvc\regex\filename\RegexMacFilename;

class RegexMacFilenameTest extends TestCase
{
    protected RegexMacFilename $regexUnixFilename;

    public function setUp(): void
    {
        $this->regexUnixFilename = new RegexMacFilename();
    }

    /**
     * testLabel
     * @covers \pvc\regex\filename\RegexUnixFilename::__construct
     */
    public function testLabel(): void
    {
        self::assertIsString($this->regexUnixFilename->getLabel());
        self::assertNotEmpty($this->regexUnixFilename->getLabel());
    }

    /**
     * testPattern
     * @param string $subject
     * @param bool $expectedResult
     * @dataProvider patternDataProvider
     * @covers       \pvc\regex\filename\RegexMacFilename::__construct
     */
    public function testPattern(string $subject, bool $expectedResult): void
    {
        self::assertEquals($expectedResult, $this->regexUnixFilename->match($subject));
    }

    public function patternDataProvider(): array
    {
        return [
            'ascii letters and numbers' => ['abc123', true],
            'unicode letter a with grave accent one codepoint' => [json_decode('"' . '\u00E0' . '"'), true],
            'unicode NUL' => [json_decode('"' . '\u0000' . '"'), false],
            'unicode backslash' => [json_decode('"' . '\u005C' . '"'), false],
        ];
    }

}
