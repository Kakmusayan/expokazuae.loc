<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
$model		= CFactory::getModel( 'videos');
$videos		= $model->getPopularVideos( 3 );

$tmpl		=	new CTemplate();
?>
<div class="cStream-Content">
	<div class="cStream-Headline">
		<b><?php echo JText::_('COM_COMMUNITY_ACTIVITIES_TOP_VIDEOS'); ?></b>
	</div>
	<div class="cStream-Attachment">
		<?php
		foreach( $videos as $video ) {
			$user = CFactory::getUser( $video->creator );
		?>

		<div class="row-fluid top-gap bottom-gap">
			<div class="span4">
				<a href="<?php echo $video->getURL();?>" class="cVideo-Thumb" >
					<img alt="<?php echo $this->escape($video->title);?>" src="<?php echo $video->getThumbnail();?>" />
					<b><?php echo $video->getDurationInHMS();?></b>
				</a>
			</div>
			<div class="span8">
				<a href="<?php echo $video->getURL();?>" class="cSnip-Title">
					<?php echo $this->escape($video->title); ?>
				</a>
				<div class="small">
				<span><?php
						if(CStringHelper::isPlural($video->getHits())) {
							echo JText::sprintf('COM_COMMUNITY_VIDEOS_HITS_COUNT_MANY', $video->getHits());
						} else {
							echo JText::sprintf('COM_COMMUNITY_VIDEOS_HITS_COUNT', $video->getHits());
						}

						?>
				</span>
				<span><?php echo JText::_('COM_COMMUNITY_VIDEOS_UPLOADED_BY'); ?> <a href="<?php echo CUrlHelper::userLink($user->id); ?>"><?php echo $user->getDisplayName(); ?></a></span>
				</div>
			</div>
		</div>

		<?php
		}
		?>
	</div>
	<?php $this->load('activities.actions'); ?>
</div>
