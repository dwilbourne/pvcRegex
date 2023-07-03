<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types = 1);

namespace pvc\regex\unicode;

use pvc\regex\Regex;

/**
 * Class RegexAlphabetic
 */
class RegexAlphabetic extends Regex
{

    /**
     * RegexAlphabetic constructor.
     *
     * we want letters represented as a single code point as well as letters modified by trailing
     * combining marks.  So we verify that the first letter in the subpattern is a letter and that
     * when the remaining code points in the subpattern are marks.
     *
     */
    public function __construct()
    {
        $label = 'alphabetic text (only letters)';
        /**
         * the u modifier after the pattern tells the engine to treat both the pattern and the subject as UTF-8
         */
        $pattern = '/^(\p{L}\p{M}*)*$/u';
        parent::__construct($pattern, $label);
    }
}
