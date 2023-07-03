<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types=1);

namespace pvc\regex\numeric;

use pvc\regex\Regex;

/**
 * Class RegexPositiveIntegerSimple
 */
class RegexPositiveIntegerSimple extends Regex
{
    public function __construct()
    {
        $label = 'simple positive integers (no grouping separator, decimal point, plus/minus signs)';
        $pattern = '/^(0|[1-9][0-9]*)$/';
        parent::__construct($pattern, $label);
    }
}
