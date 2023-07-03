<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

declare(strict_types=1);

namespace pvc\regex\text_ascii;

use pvc\regex\Regex;

/**
 * Class RegexVisibleCharsPlusHorizontalWhitespace
 * @package pvc\regex\text_ascii
 */
class RegexVisibleCharsPlusHorizontalWhitespace extends Regex
{
    public function __construct()
    {
        $label = 'visible (printable) chars plus horizontal whitespace chars';
        $pattern = '/^[ -~\h]*$/';
        parent::__construct($pattern, $label);
    }
}
