<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare (strict_types=1);

namespace pvcTests\regex\err;

use pvc\regex\err\RegexInvalidMatchIndexException;
use PHPUnit\Framework\TestCase;

class RegexInvalidMatchIndexExceptionTest extends TestCase
{
    /**
     * testConstruct
     * @covers \pvc\regex\err\RegexInvalidMatchIndexException::__construct
     */
    public function testConstruct() : void
    {
        $prev = null;
        $badIndex = 'foo';
        $exception = new RegexInvalidMatchIndexException($badIndex, $prev);
        self::assertInstanceOf(RegexInvalidMatchIndexException::class, $exception);
    }

}
