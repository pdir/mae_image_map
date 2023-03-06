<?php

declare(strict_types=1);

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

namespace Pdir\MaeImageMapBundle\ContentElement;

use Contao\ContentImage;
use Contao\Controller;
use Contao\Database;
use Contao\FilesModel;
use Contao\System;

/**
 * Class MaeImageMap.
 *
 * @author Martin Eberhardt <kontakt@martin-eberhardt.com>
 */
class MaeImageMap extends ContentImage
{
    public const refPointCenter = 'center';
    public const refPointLeftTop = 'leftTop';
    public const bgStyleCenter = 'center-bg';

    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_mae_img_map';
    protected $objMap;

    /**
     * Return if the file does not exist.
     *
     * @return string
     */
    public function generate()
    {
        return parent::generate();
    }

    /**
     * Generate content element.
     */
    protected function compile(): void
    {
        $mapPoints = '';

        // only load css and js, if this cte is in use on current page
        $GLOBALS['TL_CSS']['mae_img_map'] = 'bundles/pdirmaeimagemap/css/mae_image_map.css|static';
        //$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mae_image_map/assets/js/mae_image_map.js|static'; // TODO check this in to use .js file

        // add image
        $figure = System::getContainer()
            ->get('contao.image.studio')
            ->createFigureBuilder()
            ->from($this->objFilesModel)
            ->setSize($this->size)
            ->setMetadata($this->objModel->getOverwriteMetadata())
            ->enableLightbox((bool) $this->fullsize)
            ->buildIfResourceExists();

        if (null !== $figure)
        {
            $figure->applyLegacyTemplateData($this->Template, $this->imagemargin);
        }

        $map_id = $this->tl_mae_img_map_id;

        if ($map_id > 0) {
            $objMap = Database::getInstance()->prepare('SELECT * FROM tl_mae_img_map WHERE id = ?')->limit(1)->execute($map_id);

            if (1 === $objMap->count()) {
                $this->objMap = $objMap;
                $objArea = Database::getInstance()->prepare("SELECT * FROM tl_mae_img_map_area WHERE pid = ? AND published = '1'")->execute($map_id);

                while ($objArea->next()) {
                    $mapPoints .= $this->getMapPointHtml($objArea);
                }
            }
        }
        $this->Template->mapPoints = $mapPoints;
    }

    /**
     * returns the link html for a map point.
     *
     * @param Result $objArea
     *
     * @return string
     */
    protected function getMapPointHtml($objArea)
    {
        $hasDescription = !empty($objArea->description);
        $hasCustomClasses = !empty($objArea->cssClass);
        $hasLinkText = !empty($objArea->linktext);
        $areaDescId = 'areaDesc-'.$objArea->id;
        $linkClasses = ['area', $objArea->imageStyle];
        $descriptionClasses = ['description', 'invisible'];

        if ($hasDescription) {
            $linkClasses[] = 'hasDescription';
        }

        if ($hasLinkText) {
            $linkClasses[] = 'hasLinktext';
        }

        if ($hasCustomClasses) {
            $customClasses = trimsplit(' ', $objArea->cssClass);

            foreach ($customClasses as $customClass) {
                $linkClasses[] = $customClass;
                $descriptionClasses[] = $customClass;
            }
        }

        $href = !empty($objArea->url) ? $objArea->url : 'javascript:void(0)';
        $result = '<a class="'.implode(' ', $linkClasses).'" href="'.$href.'" title="'.$objArea->title.'"';

        if ($hasDescription) {
            $result .= ' data-description-id="'.$areaDescId.'"';
        }

        if ('1' === $objArea->target_blank) {
            $result .= ' target="_blank"';
        }
        $result .= ' style="'.$this->getAreaStyle($objArea).'"';
        $result .= '>'.($hasLinkText ? '<span>'.$objArea->linktext.'</span>' : '')."</a>\n";

        if ($hasDescription) {
            $result .= '<div id="'.$areaDescId.'" class="'.implode(' ', $descriptionClasses).'">'.$objArea->description."</div>\n";
        }

        return $result;
    }

    /**
     * @param Result $objArea
     *
     * @return string
     */
    protected function getAreaStyle($objArea)
    {
        $result = '';
        $imgWidthBase = $this->objMap->baseWidth;
        $imgHeightBase = $this->objMap->baseHeight;
        $areaWidth = '1' === $objArea->customSize ? $objArea->width : $this->objMap->stdAreaWidth;
        $areaHeight = '1' === $objArea->customSize ? $objArea->height : $this->objMap->stdAreaHeight;

        $pctWidth = $areaWidth / ($imgWidthBase / 100);
        $pctHeight = $areaHeight / ($imgHeightBase / 100);

        $result .= 'width: '.round($pctWidth, 3).'%;height: '.round($pctHeight, 3).'%;';

        $pctLeft = $objArea->coordX / ($imgWidthBase / 100);

        if (self::refPointCenter === $objArea->coordRef) {
            $pctLeft = $pctLeft - ($pctWidth / 2);
        }

        $pctTop = $objArea->coordY / ($imgHeightBase / 100);

        if (self::refPointCenter === $objArea->coordRef) {
            $pctTop = $pctTop - ($pctHeight / 2);
        }

        $result .= 'left: '.round($pctLeft, 3).'%;top: '.round($pctTop, 3).'%;';

        $bgPath = $this->getImagePath($objArea);

        if (!empty($bgPath)) {
            $result .= 'background-image: url('.$bgPath.');';
        }

        return $result;
    }

    /**
     * @param Result $objArea
     *
     * @return string
     */
    protected function getImagePath($objArea)
    {
        $result = '';

        if ('' === $objArea->image) {
            $uuid = $this->objMap->stdImage;
        } else {
            $uuid = $objArea->image;
        }

        if (empty($uuid)) {
            $result = 'bundles/pdirmaeimagemap/transparent.gif';
        } else {
            $objFile = FilesModel::findByUuid($uuid);

            if (null !== $objFile && is_file(TL_ROOT.'/'.$objFile->path)) {
                $result = $objFile->path;
            }
        }

        return $result;
    }
}
