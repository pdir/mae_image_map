<?php
// created 21.05.15 ME
ClassLoader::addNamespace('Mae');


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Elements
    'Mae\MaeImageMap'   => 'system/modules/mae_image_map/elements/MaeImageMap.php'
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'ce_mae_img_map'            => 'system/modules/mae_image_map/templates'
));
