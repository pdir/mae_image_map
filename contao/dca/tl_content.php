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

$GLOBALS['TL_DCA']['tl_content']['fields']['tl_mae_img_map_id'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['tl_mae_img_map_id'],
    'exclude'                 => false,
    'inputType'               => 'select',
    'foreignKey'              => 'tl_mae_img_map.title',
    'eval'       => array('mandatory'=>true, 'tl_class'=>'w50','chosen'=>true),
    'sql'        => "int(10) unsigned NOT NULL default 0"
);
$GLOBALS['TL_DCA']['tl_content']['palettes']['mae_img_map'] = '{type_legend},type,headline;{source_legend},singleSRC,tl_mae_img_map_id;{image_legend},alt,title,size,imagemargin;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
