<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvc\regex\php_variable_name;

use pvc\regex\Regex;

class RegexPhpVariableName extends Regex
{
    public function __construct()
    {
        $this->setLabel("php variable or label name");
        $pattern = self::PATTERN_DELIMITER . '^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$' . self::PATTERN_DELIMITER;
        $this->setPattern($pattern);
    }
}
