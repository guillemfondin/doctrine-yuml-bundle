<?php

namespace Onurb\Bundle\YumlBundle\Format\Parsers;

interface ParserInterface
{
    public static function parse(array $data): string;
}