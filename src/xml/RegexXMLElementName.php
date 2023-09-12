<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types = 1);

namespace pvc\regex\xml;

use pvc\regex\Regex;

/**
 * Class RegexXMLElementName
 */
class RegexXMLElementName extends Regex
{
    public function __construct()
    {
        $label = 'XMLElementName';

        // use a look-ahead negative assertion so no characters are consumed, case-insensitive match
        $pat_cannot_start_with_xml = '(?!(?i)xml)';

        $pat_first_character_must_be_alpha = '[a-zA-Z]';

        // "word" characters plus hyphen, period
        $pat_contains_only_letters_digits_underscores_hyphens_periods_and_no_whitespace = '[\w\-\.]*';

        $pattern = '';
        $pattern .= '/^';
        $pattern .= $pat_cannot_start_with_xml;
        $pattern .= $pat_first_character_must_be_alpha;
        $pattern .= $pat_contains_only_letters_digits_underscores_hyphens_periods_and_no_whitespace;
        $pattern .= '$/';
        $this->setPattern($pattern);
        $this->setLabel($label);
    }
}
