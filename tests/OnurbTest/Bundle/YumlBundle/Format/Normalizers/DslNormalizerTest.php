<?php

namespace OnurbTest\Bundle\YumlBundle\Format\Normalizers;

use Onurb\Bundle\YumlBundle\Format\Normalizers\DslNormalizer;
use PHPUnit\Framework\TestCase;

class DslNormalizerTest extends TestCase
{

    /**
     * @covers \Onurb\Bundle\YumlBundle\Format\Normalizers\DslNormalizer
     */
    public function testNormalize()
    {
        $dsl = '[Simple.Entity|+a;b;c{bg:red}]';
        $expected = [
            "Simple.Entity" => [
                0 => "+a",
                1 => "b",
                2 => "c",
                "params" => [
                    'bg' => 'red'
                ]
            ]
        ];

        $result = DslNormalizer::normalize($dsl);

        $this->assertEquals($result, $expected);
    }
}
