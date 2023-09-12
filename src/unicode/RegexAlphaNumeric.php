<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types = 1);

namespace pvc\regex\unicode;

use pvc\regex\Regex;

/**
 * Class RegexAlphaNumeric
 */
class RegexAlphaNumeric extends Regex
{

    /**
     * RegexAlphanumeric constructor.
     *
     * we want letters represented as a single code point as well as letters modified by trailing
     * combining marks.  So we verify that the first letter in the subpattern is a letter and that
     * when the remaining code points in the subpattern are marks.
     *
     * Numbers also have a subtlety, because there are numbers, decimal numbers, letter numbers and
     * 'other numbers'.  This expression is using decimal numbers.
     *
     */
    public function __construct()
    {
        $label = 'alphabetic text (only letters)';
        /**
         * the u modifier tells the engine to treat the subject and the pattern as UTF-8
         */
        $pattern = '/^((\p{L}\p{M}*)|\p{Nd})*$/u';
        $this->setPattern($pattern);
        $this->setLabel($label);
    }
}
