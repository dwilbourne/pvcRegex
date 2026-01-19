<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvc\regex\numeric;

use pvc\regex\Regex;

/**
 * Class RegexIntegerSimple.  Does not handle grouping separator, decimal separator, plus sign, etc.
 */
class RegexDecimalSimple extends Regex
{
    public function __construct()
    {
        $label = 'simple decimal (no grouping separator or plus signs)';
        $pattern = '/^(0|\-?[1-9][0-9]*(\.[0-9]*)?)$/';
        $this->setPattern($pattern);
        $this->setLabel($label);
    }
}
