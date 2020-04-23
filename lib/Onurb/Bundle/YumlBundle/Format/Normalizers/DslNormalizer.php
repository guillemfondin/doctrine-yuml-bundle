<?php


namespace Onurb\Bundle\YumlBundle\Format\Normalizers;


class DslNormalizer implements NormalizerInterface
{

    public static function normalize(string $dsl): array
    {
        $classesList = explode(",", $dsl);

        $entities = [];
        foreach ($classesList as $classes) {
            $relation = array_values(
                array_filter(preg_split('(\[(.*?)\])', $classes))
            );

            preg_match_all('(\[(.*?)\])', $classes, $matches);

            foreach ($matches[1] as $class) {
                $entity = [];

                list($className, $props) = explode("|", $class);
                $props = explode(";", $props);

                foreach ($props as $prop) {
                    $secondProp = explode("]", $prop);

                    if (isset($secondProp[1])) {
                        $entity[] = $secondProp[0];
                        $entity[] = $secondProp[1];
                    } else {
                        $entity[] = $prop;
                    }

                }

                if (!isset($entities[$className])) {
                    $entities[$className] = $entity;
                } else {
                    $entities[$className] = array_merge($entities[$className], $entity);
                }

                if ($relation) {
                    $entities[$className] = array_merge($entities[$className], $relation);
                }

                $last = array_key_last($entities[$className]);
                $string = $entities[$className][$last];

                if (preg_match('(\{(.*?)\})', $string, $m)) {
                    $entities[$className][$last] =  str_replace($m[0], '', $string);
                    $entities[$className] = array_values(array_unique($entities[$className]));

                    list($k, $v) = explode(":", $m[1]);
                    $entities[$className]['params'] = [$k => $v];
                } else {
                    $entities[$className] = array_values(array_unique($entities[$className]));
                }
            }
        }

        return $entities;
    }
}