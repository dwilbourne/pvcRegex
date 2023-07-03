<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare (strict_types=1);

namespace pvcTests\regex\err;

use pvc\err\XDataTestMaster;
use pvc\regex\err\_RegexXData;

/**
 * Class _RegexXDataTest
 */
class _RegexXDataTest  extends XDataTestMaster
{
    /**
     * testPvcRegexExceptionLibrary
     * @covers \pvc\regex\err\_RegexXData::getXMessageTemplates
     * @covers \pvc\regex\err\_RegexXData::getLocalXCodes
     */
    public function testPvcRegexExceptionLibrary(): void
    {
        $xData = new _RegexXData();
        self::assertTrue($this->verifylibrary($xData));
    }
}