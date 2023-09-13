<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */
declare (strict_types=1);

namespace pvcTests\regex\factory;

use pvc\regex\factory\RegexFactory;
use PHPUnit\Framework\TestCase;
use pvc\regex\Regex;

class RegexFactoryTest extends TestCase
{
    /**
     * testMakeRegex
     * @covers \pvc\regex\factory\RegexFactory::makeRegex
     */
    public function testMakeRegex(): void
    {
        $factory = new RegexFactory();
        $regex = $factory->makeRegex();
        self::assertInstanceOf(Regex::class, $regex);
    }
}
