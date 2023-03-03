<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

$date = date('Y');

$GLOBALS['ecsHeader'] = <<<EOF
Mae Image Map Bundle for Contao Open Source CMS

@package    MaeImgMap
@author     Martin Eberhardt
@license    LGPL-3.0+
@copyright  Martin Eberhardt 2015
@link       https://github.com/marebe1602/mae_image_map

forked by pdir
@author     Mathias Arzberger <develop@pdir.de>
@link       https://github.com/pdir/mae_image_map

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__.'/vendor/contao/easy-coding-standard/config/set/contao.php');

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::LINE_ENDING, "\n");

    $services = $containerConfigurator->services();
    $services
        ->set(HeaderCommentFixer::class)
        ->call('configure', [[
            'header' => $GLOBALS['ecsHeader'],
        ]])
    ;
};
