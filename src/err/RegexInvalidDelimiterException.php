<?php

declare (strict_types=1);
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

namespace pvc\regex\err;


use pvc\err\stock\LogicException;
use Throwable;

/**
 * Class RegexInvalidDelimiterException
 */
class RegexInvalidDelimiterException extends LogicException
{
    public function __construct(Throwable $prev = null)
    {
        parent::__construct($prev);
    }
}