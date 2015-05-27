<?php

namespace Mae;
use Database\Result;

/**
 * Class MaeImageMap
 * @author Martin Eberhardt <kontakt@martin-eberhardt.com>
 */
class MaeImageMap extends \Contao\ContentImage
{
    const refPointCenter    = "center";
    const refPointLeftTop   = "leftTop";
    const bgStyleCenter     = "center-bg";

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_mae_img_map';
    protected $objMap = null;


    /**
     * Return if the file does not exist
     * @return string
     */
    public function generate()
    {
        return parent::generate();
    }

    /**
     * Generate content element
     */
    protected function compile()
    {
        $mapPoints = "";

        // only load css and js, if this cte is in use on current page
        $GLOBALS['TL_CSS']['mae_img_map'] = 'system/modules/mae_image_map/assets/css/mae_image_map.css|static';
        //$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mae_image_map/assets/js/mae_image_map.js|static'; // TODO check this in to use .js file
        $this->addImageToTemplate($this->Template, $this->arrData);

        $map_id     = $this->tl_mae_img_map_id;
        if($map_id > 0) {
            $objMap = \Database::getInstance()->prepare("SELECT * FROM tl_mae_img_map WHERE id = ?")->limit(1)->execute($map_id);
            if($objMap->count() == 1) {
                $this->objMap = $objMap;
                $objArea    = \Database::getInstance()->prepare("SELECT * FROM tl_mae_img_map_area WHERE pid = ? AND published = '1'")->execute($map_id);
                while($objArea->next()) {
                    $mapPoints .= $this->getMapPointHtml($objArea);
                }
            }
        }
        $this->Template->mapPoints = $mapPoints;
    }

    /**
     * returns the link html for a map point
     * @param Result $objArea
     * @return string
     */
    protected function getMapPointHtml($objArea)
    {
        $hasDescription     = !empty($objArea->description);
        $hasCustomClasses   = !empty($objArea->cssClass);
        $areaDescId         = "areaDesc-" . $objArea->id;
        $linkClasses        = array("area", $objArea->imageStyle);
        $descriptionClasses = array('description', 'invisible');

        if($hasDescription) {
            $linkClasses[] = "hasDescription";
        }
        if($hasCustomClasses) {
            $customClasses = trimsplit(" ", $objArea->cssClass);
            foreach ($customClasses as $customClass) {
                $linkClasses[]          = $customClass;
                $descriptionClasses[]   = $customClass;
            }
        }


        $result = "<a class=\"" . implode(" ", $linkClasses) . "\" href=\"" . $objArea->url . "\" title=\"" . $objArea->title . "\"";
        if($hasDescription) {
            $result .= " data-description-id=\"" . $areaDescId . "\"";
        }
        if($objArea->target_blank == "1") {
            $result .= " target=\"_blank\"";
        }
        $result .= " style=\"" . $this->getAreaStyle($objArea) . "\"";
        $result .= "></a>\n";
        if($hasDescription) {


            $result .= "<div id=\"" . $areaDescId . "\" class=\"" . implode(" ", $descriptionClasses) . "\">" . $objArea->description . "</div>\n";
        }
        return $result;
    }

    /**
     * @param Result $objArea
     * @return string
     */
    protected function getAreaStyle($objArea)
    {
        $result = "";
        $imgWidthBase   = $this->objMap->baseWidth;
        $imgHeightBase  = $this->objMap->baseHeight;
        $areaWidth      = $objArea->customSize == '1' ? $objArea->width : $this->objMap->stdAreaWidth;
        $areaHeight     = $objArea->customSize == '1' ? $objArea->height : $this->objMap->stdAreaHeight;

        $pctWidth   = $areaWidth / ($imgWidthBase / 100);
        $pctHeight  = $areaHeight / ($imgHeightBase / 100);

        $result .=  "width: " . round($pctWidth, 3) . "%;height: " . round($pctHeight, 3) . "%;";

        $pctLeft = $objArea->coordX / ($imgWidthBase / 100);
        if($objArea->coordRef == self::refPointCenter) {
            $pctLeft = $pctLeft - ($pctWidth / 2);
        }

        $pctTop = $objArea->coordY / ($imgHeightBase / 100);
        if($objArea->coordRef == self::refPointCenter) {
            $pctTop = $pctTop - ($pctHeight / 2);
        }

        $result .= "left: " . round($pctLeft, 3) . "%;top: " . round($pctTop, 3) . "%;";

        $bgPath = $this->getImagePath($objArea);
        if(!empty($bgPath)) {
            $result .= "background-image: url(" . $bgPath . ");";
        }

        return $result;
    }

    /**
     * @param Result $objArea
     * @return string
     */
    protected function getImagePath($objArea)
    {
        $result = "";
        if ($objArea->image == '')
        {
            $uuid = $this->objMap->stdImage;
        }
        else {
            $uuid = $objArea->image;
        }
        if(empty($uuid)) {
            $result = "system/modules/mae_image_map/assets/transparent.gif";
        }
        else {

            $objFile = \FilesModel::findByUuid($uuid);
            if ($objFile !== null && is_file(TL_ROOT . '/' . $objFile->path)) {
                $result = $objFile->path;
            }
        }

        return $result;
    }
}
?>