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

namespace Pdir\MaeImageMapBundle\Tests;

use Pdir\MaeImageMapBundle\PdirMaeImageMapBundle;
use PHPUnit\Framework\TestCase;

class PdirMaeImageMapBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new PdirMaeImageMapBundle();

        $this->assertInstanceOf('Pdir\MaeImageMapBundle\PdirMaeImageMapBundle', $bundle);
    }
}