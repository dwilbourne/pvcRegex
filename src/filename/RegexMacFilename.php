<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */
declare(strict_types=1);

namespace pvc\regex\filename;

/**
 * Class RegexMacFilename
 */
class RegexMacFilename extends RegexUnixFilename
{
    public function __construct()
    {
        parent::__construct();
        $label = 'valid MacOS filename';
        $this->setLabel($label);
    }
}
