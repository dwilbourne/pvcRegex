<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare (strict_types=1);

namespace pvcTests\regex\err;

use pvc\regex\err\RegexInvalidDelimiterException;
use PHPUnit\Framework\TestCase;

class RegexInvalidDelimiterExceptionTest extends TestCase
{
    /**
     * testConstruct
     * @covers \pvc\regex\err\RegexInvalidDelimiterException::__construct
     */
    public function testConstruct() : void
    {
        $prev = null;
        $exception = new RegexInvalidDelimiterException($prev);
        self::assertInstanceOf(RegexInvalidDelimiterException::class, $exception);
    }
}
