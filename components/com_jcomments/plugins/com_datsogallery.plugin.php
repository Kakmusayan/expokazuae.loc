<?php
/**
 * JComments plugin for DatsoGallery objects support
 *
 * @version 2.2
 * @package JComments
 * @author Sergey M. Litvinov (smart@joomlatune.ru)
 * @copyright (C) 2006-2012 by Sergey M. Litvinov (http://www.joomlatune.ru)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 **/

class jc_com_datsogallery extends JCommentsPlugin
{
	function getObjectTitle($id)
	{
		$db = JCommentsFactory::getDBO();
		$db->setQuery('SELECT imgtitle, id FROM #__datsogallery WHERE id = ' . $id);
		return $db->loadResult();
	}

	function getObjectLink($id)
	{
                $db = JCommentsFactory::getDBO();
                $db->setQuery("SELECT catid FROM #__datsogallery WHERE id = " . $id);
                $catid = $db->loadResult();
 
		$_Itemid = self::getItemid('com_datsogallery');
		$link = JoomlaTuneRoute::_('index.php?option=com_datsogallery&amp;func=detail&amp;catid='.$catid.'&amp;id='.$id.'&amp;Itemid='.$_Itemid);
		return $link;
	}

	function getObjectOwner($id)
	{
		$db = JCommentsFactory::getDBO();
		$query = "SELECT u.id "
			. "\n FROM #__users AS u"
			. "\n INNER JOIN #__datsogallery AS dg ON dg.owner = u.username"
			. "\n WHERE dg.id = " . $id
			;
			
		$db->setQuery( $query );
		$userid = $db->loadResult();
		
		return intval( $userid );
	}
}
?>