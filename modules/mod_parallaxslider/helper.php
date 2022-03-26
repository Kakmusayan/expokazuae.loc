<?php
/**
 * @package Parallax Slider
 * @version 1.2
 * @author ThemeXpert http://www.themexpert.com
 * @copyright Copyright (C) 2009 - 2011 ThemeXpert
 * @license GNU General Public License version 3, or later
 *
 */

// no direct access
defined('_JEXEC') or die;

abstract class XEFParallaxSliderHelper{

   /*
    * Load add script settings
    * and push it to document head
    */
    public static function load_script($module, $params)
    {
        $doc = JFactory::getDocument();

        //Load jQuery
        XEFUtility::addjQuery($module, $params);

        // Load Modernizr if not loaded
        XEFUtility::loadModernizr($module, $params);


        $module_id = XEFUtility::getModuleId($module, $params);

        //set options array
        $options = array();

        $options[] = 'autoplay: ' . (($params->get('auto_play')) ? 'true' : 'false');
        $options[] = 'interval: ' . (int)$params->get('interval');

        $js = "
            jQuery(document).ready(function(){
                jQuery('#{$module_id}').pslider({
                    ". implode(',', $options) ."
                });
            });
        ";

        $doc->addScriptDeclaration($js);

        //Load slider js file
        if( !defined( 'PARALLAX_SLIDER' ) ){

            $doc->addScript(JURI::root(true).'/modules/mod_parallaxslider/assets/js/pslider.js');

            define( 'PARALLAX_SLIDER', 1 );
        }
    }


    /*
    * Load necesery style.
    * take all css settings and push it on document head
    */

    public static function load_style($module, $params)
    {
        $doc = JFactory::getDocument();
        $module_id = XEFUtility::getModuleId($module, $params);

        $moduleId = '#'.$module_id;
        $css = '';

        $mod_height = (int) ($params->get('mod_height', 350)) . 'px';
        $img_width = (int) ($params->get('image_width', 400));
        $img_height = (int) ($params->get('image_height', 300));

        //text position based on image size
        $text_pos = $img_width + 50;

        //assigne module height
        $css .= "$moduleId {height: $mod_height}";

        //Title position based on image widht
        /*$css .= ".ps-left .ps-title{ left: {$text_pos}px }";
        $css .= ".ps-left .ps-title.animate-in{ left: 35%; }";
        $css .= ".ps-left .ps-title.animate-out{ left: 15%; }";

        $css .= ".ps-right .ps-title{ right: {$text_pos}px }";
        $css .= ".ps-right .ps-title.animate-in{ right: 35%; }";
        $css .= ".ps-right .ps-title.animate-out{ right: 15%; }";

        //Intro position based on image widht
        $css .= ".ps-left .ps-intro{ left: {$text_pos}px }";
        $css .= ".ps-left .ps-intro.animate-in{ left: 35%; }";
        $css .= ".ps-left .ps-intro.animate-out{ left: 15%; }";

        $css .= ".ps-right .ps-intro{ right: {$text_pos}px }";
        $css .= ".ps-right .ps-intro.animate-in{ right: 35%; }";
        $css .= ".ps-right .ps-intro.animate-out{ right: 15%; }";*/

        // Image button position
        //$css .= ".ps-image img{ max-width: {$img_width}px; height: {$img_height}px; }";
        //Readmore button position
        //$css .= ".ps-left .ps-readmore{ left: {$text_pos}px }";

        //push this css on document head
        $doc->addStyleDeclaration($css);

    }

}