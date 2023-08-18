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

use Contao\DC_Table;

/**
 * Table tl_mae_img_map
 */
$GLOBALS['TL_DCA']['tl_mae_img_map'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => DC_Table::class,
        'enableVersioning'            => true,
        'ctable'                      => ['tl_mae_img_map_area'],
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 1,
            'fields'                  => array('title'),
            'flag'                    => 1,
            'panelLayout'             => 'search'
        ),
        'label' => array
        (
            'fields'                  => array('title'),
            'format'                  => '%s'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'showAreas' => array
            (
                'label'        => &$GLOBALS['TL_LANG']['tl_mae_img_map']['showAreas'],
                'href'         => 'table=tl_mae_img_map_area',
                'icon'         => 'bundles/pdirmaeimagemap/marker.png'
            ),
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mae_img_map']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mae_img_map']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mae_img_map']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_mae_img_map']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),

    // Select
    'select' => array
    (
        'buttons_callback' => array()
    ),

    // Edit
    'edit' => array
    (
        'buttons_callback' => array()
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__'                => array(''),
        'default'                     => '{title_legend},title;{data_legend},baseWidth,baseHeight,stdAreaWidth,stdAreaHeight,stdImage;{area_legend},area_edit;'
    ),

    // Subpalettes
    'subpalettes' => array
    (
        ''                            => ''
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map']['title'],
            'search'                  => true,
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>60),
            'sql'                     => "varchar(60) NOT NULL default ''"
        ),
        'baseWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map']['baseWidth'],
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>4, 'minlength'=>2, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'baseHeight' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map']['baseHeight'],
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>4, 'minlength'=>2, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'stdAreaWidth' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map']['stdAreaWidth'],
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>3, 'minlength'=>1, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'stdAreaHeight' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map']['stdAreaHeight'],
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>3, 'minlength'=>1, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'stdImage' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map']['stdImage'],
            'exclude'                 => false,
            'inputType'               => 'fileTree',
            'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'extensions'=>'%contao.image.valid_extensions%', 'mandatory'=>false, 'tl_class'=>'clr'),
            'sql'                     => "binary(16) NULL"
        ),
        'area_edit' => [
            'exclude' => true,
        ]
    )
);
