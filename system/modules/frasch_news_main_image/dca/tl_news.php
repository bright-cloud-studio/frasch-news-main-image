<?php

/**
 * Bright Cloud Studio's Frasch News Main Image
 *
 * Copyright (C) 2023 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/frasch-news-main-image
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
**/

 /* Extend the tl_news palettes */
$GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace(';{image_legend}', ';{reader_main_image_legend},addImageMainImage;{image_legend}', $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_news']['palettes']['__selector__'] = array('source', 'addImageMainImage', 'addImage', 'addEnclosure', 'overwriteMeta');
$GLOBALS['TL_DCA']['tl_news']['subpalettes']['addImageMainImage'] = 'singleSRCMainImage,sizeMainImage';

$GLOBALS['TL_DCA']['tl_news']['fields']['addImageMainImage'] = array
(
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true),
    'sql'                     => array('type' => 'boolean', 'default' => false)
);



$GLOBALS['TL_DCA']['tl_news']['fields']['singleSRCMainImage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['singleSRC'],
    'exclude'                 => true,
    'inputType'               => 'fileTree',
    'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'extensions'=>'%contao.image.valid_extensions%', 'mandatory'=>true),
    'sql'                     => "binary(16) NULL"
);

$GLOBALS['TL_DCA']['tl_news']['fields']['sizeMainImage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['MSC']['imgSize'],
    'inputType'               => 'imageSize',
    'reference'               => &$GLOBALS['TL_LANG']['MSC'],
    'eval'                    => array('rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50 clr'),
    'options_callback' => static function () {
        return System::getContainer()->get('contao.image.sizes')->getOptionsForUser(BackendUser::getInstance());
    },
    'sql'                     => "varchar(64) NOT NULL default ''"
);

