<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */
declare(strict_types=1);

namespace pvc\regex\filename;

use pvc\regex\Regex;

/**
 * Class RegexUnixFilename
 */
class RegexUnixFilename extends Regex
{
    public function __construct()
    {
        $label = 'valid Unix filename';
        /**
         * I think a technically correct answer to this is any set of characters at all, including Unicode.  As a
         * practical matter, we will not allow '/' (\x{005C}) and NUL (\x{0000}) in the pattern below).
         *
         * Note that this regex checks for illegitimate characters in a filename but is not checking the length of
         * the filename.  Length checking should be done elsewhere and should be done on byte length, not number of
         * characters (which is what pcre quantifiers calculate).
         */
        $pattern = '/^[^\x{0000}\x{0005C}]*$/u';
        $this->setPattern($pattern);
        $this->setLabel($label);
    }
}
