<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvc\regex\boolean;

use pvc\regex\Regex;

/**
 * Class RegexTrueFalse
 */
class RegexTrueFalse extends Regex
{

    /**
     * RegexTrueFalse constructor.
     */
    public function __construct()
    {
        $pattern = '/^(true|false)$/i';
        $this->setPattern($pattern);
        $label = 'true / false';
        $this->setLabel($label);
    }


}
