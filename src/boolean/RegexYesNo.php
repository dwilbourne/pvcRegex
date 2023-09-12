<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvc\regex\boolean;

use pvc\regex\Regex;

/**
 * Class RegexYesNo
 */
class RegexYesNo extends Regex
{

    public function __construct()
    {
        $pattern = '/^(yes|no)$/';
        $label = 'yes / no';
        $this->setPattern($pattern);
        $this->setLabel($label);
    }
}
