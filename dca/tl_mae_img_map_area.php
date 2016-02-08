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
 * Table tl_mae_img_map_area
 */
$GLOBALS['TL_DCA']['tl_mae_img_map_area'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
        'ptable'                      => 'tl_mae_img_map',
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'pid' => 'index'
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
			'flag'                    => 11,
            'disableGrouping'         => true,
            'panelLayout'             => 'search'
		),
		'label' => array
		(
			'fields'                  => array('title', 'coordX', 'coordY'),
			'format'                  => '<strong>%s</strong> (x,y: %s, %s)',
            'label_callback'          => array('tl_mae_img_map_area', 'label')
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
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['show'],
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
		'__selector__'                => array('customSize'),
		'default'                     => '{title_legend},title;{pos_legend},coordRef,coordX,coordY;{size_legend},customSize;{data_legend},url,target_blank,linktext,description;{bg_legend},image,imageStyle;{expert_legend},published,cssClass'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'customSize'                  => 'width,height'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
        'pid' => array
        (
            'foreignKey'              => 'tl_mae_img_map.title',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
        ),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['title'],
			'exclude'                 => false,
            'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>120),
			'sql'                     => "varchar(120) NOT NULL default ''"
		),
        'description' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['description'],
            'exclude'                 => false,
            'search'                  => true,
            'inputType'               => 'textarea',
            'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'tl_class'=>'clr'),
            'sql'                     => "mediumtext NULL"
        ),
        'coordRef' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['coordRef'],
            'exclude'                 => false,
            'inputType'               => 'select',
            'options'                 => array('center'=>&$GLOBALS['TL_LANG']['tl_mae_img_map_area']['center'],'leftTop'=>&$GLOBALS['TL_LANG']['tl_mae_img_map_area']['leftTop']),
            'eval'                    => array('mandatory'=>true),
            'sql'                     => "varchar(15) NOT NULL default 'center'"
        ),
        'coordX' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['coordX'],
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>4, 'tl_class'=>'w50 clr'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'coordY' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['coordY'],
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>4, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'customSize' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['customSize'],
            'exclude'                 => false,
            'inputType'               => 'checkbox',
            'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'width' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['width'],
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>4, 'tl_class'=>'clr w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'height' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['height'],
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>4, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'image' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['image'],
            'exclude'                 => false,
            'inputType'               => 'fileTree',
            'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'extensions'=>'png,gif', 'mandatory'=>false, 'tl_class'=>'clr w50'),
            'sql'                     => "binary(16) NULL"
        ),
        'imageStyle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['imageStyle'],
            'exclude'                 => false,
            'inputType'               => 'select',
            'options'                 => array(
                'center-bg'=>&$GLOBALS['TL_LANG']['tl_mae_img_map_area']['centerImage'],
                'left-bg'=>&$GLOBALS['TL_LANG']['tl_mae_img_map_area']['leftImage'],
                'right-bg'=>&$GLOBALS['TL_LANG']['tl_mae_img_map_area']['rightImage'],
                'stretch-bg'=>&$GLOBALS['TL_LANG']['tl_mae_img_map_area']['stretchImage']
            ),
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(15) NOT NULL default 'center-bg'"
        ),
        'url' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['url'],
            'exclude'                 => false,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50 wizard', 'mandatory'=>false),
            'wizard' => array
            (
                array('tl_mae_img_map_area', 'pagePicker')
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'target_blank' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['target_blank'],
            'exclude'                 => false,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy'=>false, 'tl_class'=>'m12 w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'linktext' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['linktext'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>200),
            'sql'                     => "varchar(200) NOT NULL default ''"
        ),
        'published' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['published'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy'=>false, 'tl_class'=>'m12 w50'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'cssClass' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_mae_img_map_area']['cssClass'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>120, 'tl_class'=>'w50'),
            'sql'                     => "varchar(120) NOT NULL default ''"
        ),
	)
);



class tl_mae_img_map_area extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Return the link picker wizard
     *
     * @param \DataContainer
     *
     * @return string
     */
    public function pagePicker(DataContainer $dc)
    {
        return ' <a href="contao/page.php?do=' . Input::get('do') . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . str_replace(array('{{link_url::', '}}'), '', $dc->value) . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\'' . specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_' . $dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '') . '\',\'self\':this});return false">' . Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
    }


    public function label($row, $label)
    {
        $result = $label;
        if(isset($row['published']) && empty($row['published'])) {
            $result = "<span style='opacity: .4'>" . $result . "</span>";
        }
        return $result;
    }

}