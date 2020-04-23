<?php

namespace OnurbTest\Bundle\YumlBundle\Format\Parsers;

use Onurb\Bundle\YumlBundle\Format\Parsers\CssClassParser;
use PHPUnit\Framework\TestCase;

class CssClassParserTest extends TestCase
{

    /**
     * @covers \Onurb\Bundle\YumlBundle\Format\Parsers\CssClassParser
     */
    public function testParse()
    {

        $cssClass = ['params' => [
            'bg' => 'red'
        ]];
        $expected = "class='bg-red '";

        $result = CssClassParser::parse($cssClass);

        $this->assertEquals($result, $expected);
    }
}
