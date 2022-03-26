<?php
/**
 * Element: Toggler
 * Adds slide in and out functionality to framework based on an framework value
 *
 * @package			NoNumber! Framework
 * @version			11.12.10
 * @author			Peter van Westen <peter@nonumber.nl>
 * @link			http://www.nonumber.nl
 * @copyright		Copyright © 2011 NoNumber! All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

error_reporting(0);

// No direct access
defined( '_JEXEC' ) or die();

/**
 * Toggler Element
 *
 * To use this, make a start xml param tag with the param and value set
 * And an end xml param tag without the param and value set
 * Everything between those tags will be included in the slide
 *
 * Available extra parameters:
 * param			The name of the reference parameter
 * value			a comma separated list of value on which to show the framework
 */
class nnFieldToggler
{
	var $_version = 'ju_201201';

	function getInput( $name, $id, $value, $params, $children, $j15 = 0 )
	{
		$this->params = $params;

		$option = JRequest::getCmd( 'option' );

		$param = $this->def( 'param' );
		$value = $this->def( 'value' );
		$nofx = $this->def( 'nofx' );
		$horz = $this->def( 'horizontal' );
		$method = $this->def( 'method' );

		JHtml::_( 'behavior.mootools' );
		$document = JFactory::getDocument();
		$document->addScript( JURI::root( true ).'/modules/mod_junewsultra/assets/js/script.js?v='.$this->_version );
		$document->addScript( JURI::root( true ).'/modules/mod_junewsultra/assets/js/toggler.js?v='.$this->_version );

		$param = preg_replace( '#^\s*(.*?)\s*$#', '\1', $param );
		$param = preg_replace( '#\s*\|\s*#', '|', $param );

		if ( $param != '' ) {
			$param = preg_replace( '#[^a-z0-9-\.\|\@]#', '_', $param );

			$param = str_replace( '@', '_', $param );

			$set_groups = explode( '|', $param );
			$set_values = explode( '|', $value );
			$ids = array();
			foreach ( $set_groups as $i => $group ) {
				$count = $i;
				if ( $count >= count( $set_values ) ) {
					$count = 0;
				}
				$value = explode( ',', $set_values[$count] );
				foreach ( $value as $val ) {
					$ids[] = $group.'.'.$val;
				}
			}

			$html = "\n";

			$html .= '</li><li style="clear: both;">';

			$html .= '<div id="'.rand( 1000000, 9999999 ).'___'.implode( '___', $ids ).'" class="nntoggler';
			if ( $nofx ) {
				$html .= ' nntoggler_nofx';
			}
			if ( $horz ) {
				$html .= ' nntoggler_horizontal';
			}
			if ( $method == 'and' ) {
				$html .= ' nntoggler_and';
			}
			$html .= '">';
			if ( $j15 ) {
				$html .= '<table width="100%" class="paramlist admintable" cellspacing="1">';
				$html .= '<tr style="height:auto;"><td colspan="2" class="paramlist_value">';
				$random = rand( 100000, 999999 );
				$html .= '<div id="end-'.$random.'"></div><script type="text/javascript">NNFrameworkHideTD( "end-'.$random.'" );</script>';
			} else {
				$html .= '<ul><li>'."\n";
			}
		} else {

				$html = "\n".'</li></ul>';
				$html .= '<div style="clear: both;"></div>';
				$html .= '</div>'."\n";

		}

		return $html;
	}

	private function def( $val, $default = '' )
	{
		return ( isset( $this->params[$val] ) && (string) $this->params[$val] != '' ) ? (string) $this->params[$val] : $default;
	}
}


	// For Joomla 1.6
	class JFormFieldNN_Toggler extends JFormField
	{
		/**
		 * The form field type
		 *
		 * @var		string
		 */
		public $type = 'Toggler';

		protected function getLabel()
		{
			return;
		}

		protected function getInput()
		{
			$this->_nnfield = new nnFieldToggler();
			return $this->_nnfield->getInput( $this->name, $this->id, $this->value, $this->element->attributes(), $this->element->children() );
		}
	}
