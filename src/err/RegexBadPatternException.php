<?php

/**
 * @package: pvcRegex
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types = 1);

namespace pvc\regex\err;

use pvc\err\stock\LogicException;
use Throwable;

/**
 * Class RegexInvalidRegexException
 */
class RegexBadPatternException extends LogicException
{
    public function __construct(string $badPattern, Throwable $previous = null)
    {
        parent::__construct($badPattern, $previous);
    }
}
