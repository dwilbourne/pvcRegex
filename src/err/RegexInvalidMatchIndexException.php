<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare(strict_types = 1);

namespace pvc\regex\err;

use pvc\err\stock\LogicException;
use Throwable;

/**
 * Class RegexInvalidMatchIndexException
 */
class RegexInvalidMatchIndexException extends LogicException
{
    /**
     * RegexInvalidMatchIndexException constructor.
     * @param int|string $badIndex
     * @param Throwable|null $previous
     * @throws \ReflectionException
     * @throws \ReflectionException
     */
    public function __construct($badIndex, Throwable $previous = null)
    {
        parent::__construct($badIndex, $previous);
    }
}
