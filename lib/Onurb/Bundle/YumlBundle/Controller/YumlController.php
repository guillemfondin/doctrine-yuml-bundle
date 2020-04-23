<?php

namespace Onurb\Bundle\YumlBundle\Controller;

use Onurb\Bundle\YumlBundle\Format\Normalizers\DslNormalizer;
use Onurb\Bundle\YumlBundle\Format\Parsers\HtmlParser;
use Onurb\Bundle\YumlBundle\Yuml\YumlClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Utility to generate Yuml compatible strings from metadata graphs
 * Adaptation of DoctrineORMModule\Yuml\YumlController for ZendFramework-Zend-Developer-Tools
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @author  Bruno Heron <herobrun@gmail.com>
 * @author  Marco Pivetta <ocramius@gmail.com>
 */
class YumlController extends AbstractController
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        /** @var YumlClient $yumlClient */
        $yumlClient = $this->get('onurb_yuml.client');

        $showDetailParam    = $this->container->getParameter('onurb_yuml.show_fields_description');
        $colorsParam        = $this->container->getParameter('onurb_yuml.colors');
        $notesParam         = $this->container->getParameter('onurb_yuml.notes');
        $styleParam         = $this->container->getParameter('onurb_yuml.style');
        $extensionParam     = $this->container->getParameter('onurb_yuml.extension');
        $directionParam     = $this->container->getParameter('onurb_yuml.direction');
        $scale              = $this->container->getParameter('onurb_yuml.scale');

        if ($extensionParam === 'html') {
            $dsl = $yumlClient->makeDslText($showDetailParam, $colorsParam, $notesParam);

            $entities = DslNormalizer::normalize($dsl);
            $html = HtmlParser::parse($entities);

            return $this->render('@OnurbYuml/index.html.twig', [
                'data' => $dsl,
                'html' => $html
            ]);
        } else {
            return $this->redirect(
                $yumlClient->getGraphUrl(
                    $yumlClient->makeDslText($showDetailParam, $colorsParam, $notesParam),
                    $styleParam,
                    $extensionParam,
                    $directionParam,
                    $scale
                )
            );
        }
    }
}
