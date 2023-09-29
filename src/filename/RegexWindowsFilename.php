<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types = 1);

namespace pvc\regex\filename;

use pvc\regex\err\RegexInvalidDelimiterException;
use pvc\regex\Regex;

/**
 * Class RegexWindowsFilename
 *
 * Documentation for windows file names can be found at
 * https://docs.microsoft.com/en-us/windows/desktop/FileIO/naming-a-file
 */
class RegexWindowsFilename extends Regex
{
    public function __construct(bool $allowFileExtension = true)
    {
        /**
         * illegal filenames are coded as a series of case-insensitive negative lookahead assertions
         * first bracket each filename with begin / end of subject
         */

        $badFileNames = [];
        foreach ($this->getIllegalFilenames() as $filename) {
            $badFileNames[] = '^' . $filename . '$';
        }

        $pattern = '';
        $pattern .= '/^(?!(?i)(' . implode('|', $badFileNames) . '))';

        // illegal characters are coded as a negative character class.
        $pattern .= '[^' . $this->getIllegalChars($allowFileExtension) . ']*';

        // assert end of subject / end of pattern
        $pattern .= '$/';

        $label = 'windows filename';

        $this->setPattern($pattern);
        $this->setLabel($label);
    }

    /**
     * getIllegalFilenames
     * @return array<string>
     */
    private function getIllegalFilenames(): array
    {
        $illegalFilenames = [];
        $illegalFilenames[] = 'CON';
        $illegalFilenames[] = 'PRN';
        $illegalFilenames[] = 'AUX';
        $illegalFilenames[] = 'NUL';
        for ($i = 1; $i < 10; $i++) {
            $illegalFilenames[] = 'COM' . $i;
            $illegalFilenames[] = 'LPT' . $i;
        }
        return $illegalFilenames;
    }

    /**
     * getIllegalChars
     * @param bool $allowFileExtension
     * @return string
     * @throws RegexInvalidDelimiterException
     * @throws RegexInvalidDelimiterException
     */
    // the following chars are illegal: < > : " \ / | ? *
    private function getIllegalChars(bool $allowFileExtension): string
    {
        $result = '<>:"\/|?*';
        if (!$allowFileExtension) {
            $result .= '.';
        }
        return Regex::escapeString($result, '/');
    }
}
