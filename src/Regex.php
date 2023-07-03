<?php

/**
 * @package pvcRegex
 * @author Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types=1);

namespace pvc\regex;

use pvc\regex\err\RegexBadPatternException;
use pvc\regex\err\RegexInvalidDelimiterException;
use pvc\regex\err\RegexInvalidMatchIndexException;
use Throwable;

/**
 *
 * @class Regex
 *
 * Object that wraps preg_match
 *
 */

class Regex
{

    /**
     * Regex pattern to be used in trying to match the subject.  Includes delimiters.
     *
     * @var string $pattern
     *
     */

    protected string $pattern;

    protected bool $caseSensitive = true;

    /**
     *
     * Array that holds the captured pieces of the subject.
     * The matches array is not settable externally - it can only be populated as a result of
     * running the match method in this class.
     *
     * @var array<mixed> $matches
     *
     */

    protected array $matches = [];

    /**
     * @var string
     *
     * describes what the regex is.  For example, if this regex determines whether a string is a valid windows
     * filename, then an appropriate label would be "valid windows filename".
     */
    protected string $label;
    
    public function __construct(string $pattern, string $label)
    {
        $this->setPattern($pattern);
        $this->setLabel($label);
    }

    /**
     *
     * @function setPattern();
     *
     * sets a regex pattern
     *
     * @param string $pattern .
     *
     * @return void
     * @throws RegexBadPatternException
     */

    public function setPattern(string $pattern): void
    {
        if (!$this->validatePattern($pattern)) {
            throw new RegexBadPatternException($pattern);
        } else {
            $this->pattern = $pattern;
        }
    }

    /**
     *
     * @function getPattern();
     *
     * gets the regex pattern
     *
     * @returns string;
     *
     */

    public function getPattern(): ?string
    {
        return $this->pattern ?? '';
    }

    /**
     * @return bool
     */
    public function isCaseSensitive(): bool
    {
        return $this->caseSensitive;
    }

    /**
     * @param bool $caseSensitive
     */
    public function setCaseSensitive(bool $caseSensitive): void
    {
        $this->caseSensitive = $caseSensitive;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label . (!$this->isCaseSensitive() ? '(not case sensitive)' : '');
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @function getMatch()
     *
     * $index can be numeric or a string depending on whether you used a named subpattern or not.
     * @param int|string $index
     *
     * returns false if there is no such index set, returns a string if the $matchAll property is false
     * otherwise returns an array
     * @return string|array|false
     *
     * @throws RegexInvalidMatchIndexException
     */

    public function getMatch(int|string $index): bool|array|string
    {
        if (!isset($this->matches[$index])) {
            throw new RegexInvalidMatchIndexException($index);
        }
        return $this->matches[$index];
    }

    /**
     * @function getMatches()
     *
     * @return array
     *
     */

    public function getMatches(): array
    {
        return $this->matches;
    }


    /**
     * @function validatePattern
     * @param string $pattern
     * @return bool
     * validates a regex pattern.
     */
    public static function validatePattern(string $pattern): bool
    {
        // preg_match outputs an error (severity = warning) and returns FALSE if it fails.
        try {
            preg_match($pattern, '');
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    /**
     * @function validateDelimiter
     * @param string $delimiter
     * @return bool
     *
     * delimiter must be a single char, not alphanumeric, not whitespace and not a backslash
     */
    public static function validateDelimiter(string $delimiter): bool
    {
        return !((strlen($delimiter) > 1) || (ctype_alnum($delimiter)) || ('\\' == $delimiter) || (ctype_space(
            $delimiter
        )));
    }

    /**
     * escapeString
     * @param string $pattern - without delimiters
     * @return string
     *
     * preg_quote is kind of mis-named.  It does not quote special characters in a pattern, it escapes
     * them using a backslash. Its intended use is for creating a regex pattern from a string generated
     * at runtime.  So the idea is that a pattern argument might contain special characters which would
     * need to be escaped, but you don't know because the system generates the text.  So to be sure the special
     * characters are escaped, you use preg_quote.
     *
     * Moreover, the system does not know what delimiters you want to use on your regex.  And if by chance your
     * runtime-generated pattern should contain the character you intend to use as a delimiter, then
     * your regex will be messed up because if it is not escaped, it will terminate the pattern and the rest of the
     * characters become trailing junk.  By supplying your delimiter as the second argument to this function, PHP will
     * escape that character as well in your pattern (before you prepend and append the delimiters of
     * course) so that the delimiter character in the middle of your pattern does not muddle your pattern.
     *
     * So the correct usage of this method is to supply the pattern argument without delimiters and to
     * supply the delimiter argument so that if that character should by chance appear in the pattern,
     * it can be properly escaped.
     * @throws RegexInvalidDelimiterException
     * @throws RegexInvalidDelimiterException
     */
    public static function escapeString(string $pattern, string $delimiter) : string
    {
        if (!self::validateDelimiter($delimiter)) {
            throw new RegexInvalidDelimiterException();
        }
        return preg_quote($pattern, $delimiter);
    }

    /**
     * All Regex classes use this method in order to test whether a given subject matches the pattern.
     *
     * @function match bool.
     *
     * @param string $subject
     *
     * $matchAll toggles the preg_match_all verb, meaning that all matches are returned, not just the first one.
     * @param bool $matchAll
     *
     * @return bool.  Returns true or false, throws an error if preg_match throws an error.
     */

    public function match(string $subject, bool $matchAll = false): bool
    {
        $pattern = $this->getPattern() . (!$this->isCaseSensitive() ? 'i' : '');

        if ($matchAll) {
            $result = preg_match_all($pattern, $subject, $this->matches);
        } else {
            $result = preg_match($pattern, $subject, $this->matches);
        }

        // $result should never be false because pattern was validated when it was set

        return ($result != 0);
    }
}
