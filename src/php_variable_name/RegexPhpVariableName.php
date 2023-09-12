<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

declare(strict_types=1);

namespace pvc\regex\php_variable_name;

use pvc\regex\Regex;

class RegexPhpVariableName extends Regex
{
    public function __construct()
    {
        $label = 'php variable or label name';
        $pattern = '/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/';
        $this->setPattern($pattern);
        $this->setLabel($label);
    }
}
