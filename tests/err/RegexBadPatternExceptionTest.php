<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types=1);

namespace pvcTests\regex\err;

use PHPUnit\Framework\TestCase;
use pvc\regex\err\RegexBadPatternException;

/**
 * Class RegexBadPatternExceptionTest
 */
class RegexBadPatternExceptionTest extends TestCase
{

    /**
     * testConstruct
     * @covers \pvc\regex\err\RegexBadPatternException::__construct
     */
    public function testConstruct() : void
    {
        $pattern = '/foo';
        $prev = null;
        $exception = new RegexBadPatternException($pattern, $prev);
        self::assertInstanceOf(RegexBadPatternException::class, $exception);
    }
}