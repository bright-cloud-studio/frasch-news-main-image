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
$GLOBALS['TL_DCA']['tl_news']['subpalettes']['addImageMainImage'] = 'singleSRCMainImage,fullsizeMainImage,sizeMainImage,floatingMainImage,overwriteMetaMainImage';

$GLOBALS['TL_DCA']['tl_news']['fields']['addImageMainImage'] = array
(
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true),
    'sql'                     => array('type' => 'boolean', 'default' => false)
);



$GLOBALS['TL_DCA']['tl_news']['fields']['singleSRCMainImage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['singleSRCMainImage'],
    'inputType'               => 'fileTree',
    'exclude'                 => true,
    'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'extensions'=>'%contao.image.valid_extensions%', 'mandatory'=>true),
    'sql'                     => "binary(16) NULL"
);

$GLOBALS['TL_DCA']['tl_news']['fields']['fullsizeMainImage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['fullsizeMainImage'],
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => array('type' => 'boolean', 'default' => false)
);

$GLOBALS['TL_DCA']['tl_news']['fields']['sizeMainImage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['MSC']['sizeMainImage'],
    'inputType'               => 'imageSize',
    'reference'               => &$GLOBALS['TL_LANG']['MSC'],
    'eval'                    => array('rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50 clr'),
    'options_callback' => static function () {
        return System::getContainer()->get('contao.image.sizes')->getOptionsForUser(BackendUser::getInstance());
    },
    'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_news']['fields']['floatingMainImage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['floatingMainImage'],
    'inputType'               => 'radioTable',
    'options'                 => array('above', 'left', 'right', 'below'),
    'eval'                    => array('cols'=>4, 'tl_class'=>'w50'),
    'reference'               => &$GLOBALS['TL_LANG']['MSC'],
    'sql'                     => "varchar(12) NOT NULL default 'above'"
);

$GLOBALS['TL_DCA']['tl_news']['fields']['overwriteMetaMainImage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['overwriteMetaMainImage'],
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 clr'),
    'sql'                     => array('type' => 'boolean', 'default' => false)
);
