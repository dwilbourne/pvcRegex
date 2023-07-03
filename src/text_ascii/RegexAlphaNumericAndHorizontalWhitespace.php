<?php

/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types = 1);

namespace pvc\regex\text_ascii;

use pvc\regex\Regex;

/**
 * Class RegexAlphaNumericAndHorizontalWhitespace
 */
class RegexAlphaNumericAndHorizontalWhitespace extends Regex
{
    public function __construct()
    {
        $label = 'alphanumeric or a horizontal whitespace character';
        $pattern = '/^[a-zA-Z0-9\h]*$/';
        parent::__construct($pattern, $label);
    }
}
