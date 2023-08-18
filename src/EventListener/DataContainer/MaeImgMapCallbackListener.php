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

namespace Pdir\MaeImageMapBundle\EventListener\DataContainer;

use Contao\BackendTemplate;
use Contao\DataContainer;

class MaeImgMapCallbackListener
{
    /*
     * Callback for area edit input field in back end
     *
     * @Callback(table="tl_mae_img_map", target="fields.area_edit.input_field", method="areaEditInputField", prority=-12)
     *
     */
    public function areaEditInputField(DataContainer $dc, $label): string
    {
        $template = new BackendTemplate('be_mae_area_edit');

        // prepare template vars
        $template->name = $dc->activeRecord->name;
        $template->panoId = $dc->activeRecord->id;

        return $template->parse();
    }
}
