<?php

/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types=1);

namespace pvc\regex\text_ascii;

use pvc\regex\Regex;

/**
 * Class RegexTextAlphaNumeric
 */
class RegexAlphaNumeric extends Regex
{
    public function __construct()
    {
        $label = 'alphanumeric text (only letters and numbers)';
        /**
         * having trouble with POSIX notation on my system - gives a compile error....
         * $patternWithDelimiters = '/^[:alnum:]*$/';
         */
        $pattern = '/^[a-zA-Z0-9]*$/';
        parent::__construct($pattern, $label);
    }
}
