<?php


namespace Onurb\Bundle\YumlBundle\Format\Normalizers;


interface NormalizerInterface
{
    public static function normalize(string $string): array;
}