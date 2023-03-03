<?php

declare(strict_types=1);

namespace Pdir\MaeImageMapBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Pdir\MaeImageMapBundle\PdirMaeImageMapBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(PdirMaeImageMapBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['mae_image_map']),
        ];
    }
}
