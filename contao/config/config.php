<?php

/*
 * Mae Image Map Bundle for Contao Open Source CMS
 *
 * @package    MaeImgMap
 * @author     Martin Eberhardt
 * @license    LGPL-3.0+
 * @copyright  Martin Eberhardt 2015
 * @link       https://github.com/marebe1602/mae_image_map
 *
 * forked by pdir
 * @author     Mathias Arzberger <develop@pdir.de>
 * @link       https://github.com/pdir/mae_image_map
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Contao\ArrayUtil;

/**
 * Back end modules
 */
$imgMapModAr = [
    'mae_image_map' => [
        'tables' => ['tl_mae_img_map', 'tl_mae_img_map_area'],
        'icon' => 'bundles/pdirmaeimagemap/image_map.png'
    ]
];

ArrayUtil::arrayInsert($GLOBALS['BE_MOD']['content'], 1, $imgMapModAr);

/**
 * Content Elements
 */
$GLOBALS['TL_CTE']['media']['mae_img_map'] = '\Pdir\MaeImageMapBundle\ContentElement\MaeImageMap';
