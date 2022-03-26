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
defined('_JEXEC') or die('Restricted accessd');
$i=0;
?>

<!-- ThemeXpert: Parallax Slider module 1.2 Start here -->
<div id="<?php echo $module_id;?>" class="parallax-slider clearfix <?php echo $params->get('moduleclass_sfx');?> ">

        <?php foreach($items as $item) :?>
        <?php
            if( $params->get('image_position') == 'alt')
                {
                    $current_position = ($i%2) ? 'left' : 'right';

                }else{
                    $current_position = $params->get('image_position');
                }
        ?>
            <div class="ps-<?php echo $i; ?> ps-slide ps-<?php echo $current_position;?>">

                <?php if($params->get('title')):?>

                    <h3 class="ps-title">
                        <?php if( $params->get('link') ) :?>
                            <a href="<?php echo $item->link; ?>">
                        <?php endif; ?>

                        <?php echo $item->title;?>

                        <?php if( $params->get('link') ) :?>
                            </a>
                        <?php endif; ?>
                    </h3>

                <?php endif; ?>

                <?php if( $params->get('intro') ):?>
                    <p class="ps-intro">
                        <?php echo $item->introtext; ?>
                    </p>
                <?php endif;?>

                <?php if( $params->get('readmore') ): ?>
                    <a class="btn ps-readmore" href="<?php echo $item->link; ?>">
                        <?php echo $params->get('readmore_text');?>
                    </a>
                <?php endif; ?>

                <?php if( $params->get('image') ) :?>
                    <div class="ps-image">
                        <img src="<?php echo $item->image ;?>" alt="<?php echo $item->title;?>" />
                    </div>
                <?php endif;?>


            </div>
        <?php $i++; endforeach ; ?>

    <?php if($params->get('control')):?>
        <div class="ps-arrows">
            <span class="ps-arrows-prev"></span>
            <span class="ps-arrows-next"></span>
        </div>
    <?php endif;?>

</div>
<!-- ThemeXpert: Parallax Slider module 1.2 End Here -->