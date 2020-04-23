<?php

namespace OnurbTest\Bundle\YumlBundle\Format\Parsers;

use Onurb\Bundle\YumlBundle\Format\Normalizers\DslNormalizer;
use Onurb\Bundle\YumlBundle\Format\Parsers\HtmlParser;
use PHPUnit\Framework\TestCase;

class HtmlParserTest extends TestCase
{

    /**
     * @covers \Onurb\Bundle\YumlBundle\Format\Parsers\HtmlParser
     */
    public function testParse()
    {

        $dsl = '[Simple.Entity|+a;b;c{bg:red}]';
        $data = DslNormalizer::normalize($dsl);

        $expected = "<ul class='bg-red '>";
            $expected .= "<li style=\"white-space: pre;\">Simple.Entity</li>";
            $expected .= "<ul>";
                $expected .= "<li style=\"white-space: pre;\">+a</li>";
                $expected .= "<li style=\"white-space: pre;\">b</li>";
                $expected .= "<li style=\"white-space: pre;\">c</li>";
            $expected .= "</ul>";
        $expected .= "</ul>";

        $result = HtmlParser::parse($data);

        $this->assertEquals($result, $expected);
    }
}
