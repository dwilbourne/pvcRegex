<?php

/**
 * @package pvcRegex
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @noinspection PhpCSValidationInspection
 */

declare (strict_types=1);

namespace pvc\regex\err;

use pvc\err\XDataAbstract;
use pvc\interfaces\err\XDataInterface;

/**
 * Class _RegexXData
 */
class _RegexXData extends XDataAbstract implements XDataInterface
{

    public function getLocalXCodes(): array
    {
        return [
            RegexBadPatternException::class => 1001,
            RegexInvalidDelimiterException::class => 1002,
            RegexInvalidMatchIndexException::class => 1003,
        ];
    }

    public function getXMessageTemplates(): array
    {
        return [
            RegexBadPatternException::class => 'Pattern ${badPattern} is not a valid regular expression.',
            RegexInvalidDelimiterException::class => 'delimiter must be a single char, not alphanumeric, not whitespace and not a backslash.',
            RegexInvalidMatchIndexException::class => 'match index ${badIndex}: no such index in the matches array.',

        ];
    }
}
