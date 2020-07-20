<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvc\regex\numeric;

use pvc\regex\Regex;

/**
 * Class RegexIntegerSimple.  Does not handle grouping separator, decimal separator, plus sign, etc.
 * @package pvc\regex\numeric
 */
class RegexIntegerSimple extends Regex
{
    public function __construct()
    {
        $this->setLabel("simple integers (no grouping sepatator or plus signs)");
        $pattern = self::PATTERN_DELIMITER . '^(0|\-?[1-9][0-9]*)$' . self::PATTERN_DELIMITER;
        $this->setPattern($pattern);
    }
}
