<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */
declare(strict_types=1);

namespace pvc\regex\factory;

use pvc\interfaces\regex\RegexFactoryInterface;
use pvc\regex\Regex;

/**
 * Class RegexFactory
 */
class RegexFactory implements RegexFactoryInterface
{
    public function makeRegex(): Regex
    {
        return new Regex();
    }
}
