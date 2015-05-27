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

/**
 * Back end modules
 */
$imgMapModAr = array (
    'mae_image_map' => array (
        'tables' => array('tl_mae_img_map', 'tl_mae_img_map_area'),
        'icon' => 'system/modules/mae_image_map/assets/image_map.png'
    )
);
array_insert($GLOBALS['BE_MOD']['content'], 1, $imgMapModAr);

/**
 * Content Elements
 */
$GLOBALS['TL_CTE']['media']['mae_img_map'] = 'MaeImageMap';