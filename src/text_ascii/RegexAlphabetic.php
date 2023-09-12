<?php

/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

declare(strict_types = 1);

namespace pvc\regex\text_ascii;

use pvc\regex\Regex;

/**
 * Class RegexAlphabetic
 */
class RegexAlphabetic extends Regex
{
    public function __construct()
    {
        $label = 'alphabetic text (only letters)';
        /**
         * having trouble with POSIX notation on my system - gives a compile error....
         * $pattern = '/^[:alpha:]*$/';
         */
        $pattern = '/^[a-zA-Z]*$/';
        $this->setPattern($pattern);
        $this->setLabel($label);
    }
}
