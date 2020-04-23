<?php


namespace Onurb\Bundle\YumlBundle\Format\Parsers;


class HtmlParser implements ParserInterface
{

    public static function parse(array $data): string
    {
        $html = "";
        foreach ($data as $className => $props) {
            $attr = CssClassParser::parse($props);

            $html .= "<ul $attr>";
            $html .= "<li>".htmlspecialchars($className)."</li>";
            $html .= "<ul>";

            foreach ($props as $prop) {
                if (!is_string($prop)) {
                    continue;
                }

                $html .= "<li>".htmlspecialchars($prop)."</li>";
            }

            $html .= "</ul>";
            $html .= "</ul>";
        }

        return $html;
    }
}