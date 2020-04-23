<?php


namespace Onurb\Bundle\YumlBundle\Format\Parsers;


class CssClassParser implements ParserInterface
{

    public static function parse(array $props): string
    {
        if (isset($props['params'])) {
            $attr = "";
            foreach ($props['params'] as $key => $param) {
                $attr .= "$key-$param ";
            }

            return "class='" .$attr. "'";
        }

        return '';
    }
}