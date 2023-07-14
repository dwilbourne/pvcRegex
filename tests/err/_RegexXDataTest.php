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
     * @function testPvcRegexExceptionLibrary
     * @covers \pvc\regex\err\_RegexXData::getXMessageTemplates
     * @covers \pvc\regex\err\_RegexXData::getLocalXCodes
     * @covers \pvc\regex\err\RegexBadPatternException::__construct
     * @covers \pvc\regex\err\RegexInvalidDelimiterException::__construct
     * @covers \pvc\regex\err\RegexInvalidMatchIndexException::__construct
     */
    public function testPvcRegexExceptionLibrary(): void
    {
        $xData = new _RegexXData();
        self::assertTrue($this->verifylibrary($xData));
    }
}