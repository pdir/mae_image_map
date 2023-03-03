<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package   MaeImgMap
 * @author    Martin Eberhardt
 * @license   GNU/LGPL
 * @copyright Martin Eberhardt 2015
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
