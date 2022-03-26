<?php
/**
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc & Mukazhan Dastan DASTIW1 (http://joomlaforum.kz)
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * kz-KZ localise class
 *
 * @package		Joomla.Site
 * @since		1.6
 */
abstract class kz_KZLocalise
{
	/**
	 * Returns the potential suffixes for a specific number of items
	 *
	 * @param	int $count  The number of items.
	 * @return	array  An array of potential suffixes.
	 * @since	1.6
	 */
	public static function getPluralSuffixes($count)
	{
		if ($count == 0) {
			$return = array('0');
		} else {
			$return = array(($count%10==1 && $count%100!=11 ? '1' : ($count%10>=2 && $count%10<=4 && ($count%100<10 || $count%100>=20) ? '2' : 'MORE')));
		}
		return $return;
	}

	public static function transliterate($string)
	{
		$str = JString::strtolower($string);

		$glyph_array = array(
			'a' => 'а',
			'a' => 'ә',
			'b' => 'б',
			'v' => 'в',
			'g' => 'ғ',
			'g' => 'г,ґ',
			'd' => 'д',
			'e' => 'е,є,э',
			'jo' => 'ё',
			'zh' => 'ж',
			'z' => 'з',
			'i' => 'и,і',
			'ji' => 'ї',
			'j' => 'й',
			'k' => 'к',
			'k' => 'қ',
			'l' => 'л',
			'm' => 'м',
			'n' => 'н',
			'o' => 'о',
			'o' => 'ө',
			'p' => 'п',
			'r' => 'р',
			's' => 'с',
			't' => 'т',
			'u' => 'ұ',
			'u' => 'ү',
			'u' => 'у',
			'f' => 'ф',
			'kh' => 'х',
			'h' => 'һ',
			'ts' => 'ц',
			'ch' => 'ч',
			'sh' => 'ш',
			'shch' => 'щ',
			'' => 'ъ',
			'y' => 'ы',
			'' => 'ь',
			'yu' => 'ю',
			'ya' => 'я',
		);

		foreach ($glyph_array as $letter => $glyphs) {
			$glyphs = explode(',', $glyphs);
			$str = str_replace($glyphs, $letter, $str);
		}

		$str = preg_replace('#\&\#?[a-z0-9]+\;#ismu', '', $str);

		return $str;
	}

	/**
	 * Returns the ignored search words
	 *
	 * @return	array  An array of ignored search words.
	 * @since	1.6
	 */
	public static function getIgnoredSearchWords()
	{
		$search_ignore = array();
		$search_ignore[] = 'href';
		$search_ignore[] = 'lol';
		$search_ignore[] = 'www';
		$search_ignore[] = 'а';
		$search_ignore[] = 'без';
		$search_ignore[] = 'рақмет';
		$search_ignore[] = 'үшін';
		$search_ignore[] = 'жақын';
		$search_ignore[] = 'көбірек';
		$search_ignore[] = 'қарағанда';
		$search_ignore[] = 'үлкен';
		$search_ignore[] = 'дәу';
		$search_ignore[] = 'болады';
		$search_ignore[] = 'болды';
		$search_ignore[] = 'бола тұра';
		$search_ignore[] = 'болды';
		$search_ignore[] = 'сізді';
		$search_ignore[] = 'сізге';
		$search_ignore[] = 'сізбен';
		$search_ignore[] = 'сіздің';
		$search_ignore[] = 'сіздікі';
		$search_ignore[] = 'жақында';
		$search_ignore[] = 'мысалға';
		$search_ignore[] = 'керемет';
		$search_ignore[] = 'ішінде';
		$search_ignore[] = 'іші';
		$search_ignore[] = 'қасында';
		$search_ignore[] = 'міне';
		$search_ignore[] = 'уақыт';
		$search_ignore[] = 'время';
		$search_ignore[] = 'бәрібір';
		$search_ignore[] = 'бар';
		$search_ignore[] = 'әрқашан';
		$search_ignore[] = 'барлығы';
		$search_ignore[] = 'бәрін';
		$search_ignore[] = 'кез-келген';
		$search_ignore[] = 'көрінеді';
		$search_ignore[] = 'қайда';
		$search_ignore[] = 'йә';
		$search_ignore[] = 'алыста';
		$search_ignore[] = 'расында';
		$search_ignore[] = 'күн';
		$search_ignore[] = 'күнде';
		$search_ignore[] = 'үй';
		$search_ignore[] = 'үйде';
		$search_ignore[] = 'үймен';
		$search_ignore[] = 'оны';
		$search_ignore[] = 'егер';
		$search_ignore[] = 'бар';
		$search_ignore[] = 'не';
		$search_ignore[] = 'армандапсың';
		$search_ignore[] = 'біледі';
		$search_ignore[] = 'білді';
		$search_ignore[] = 'білем';
		$search_ignore[] = 'және';
		$search_ignore[] = 'т с.с';
		$search_ignore[] = 'ж т.б';
		$search_ignore[] = 'кейді';
		$search_ignore[] = 'іздеді';
		$search_ignore[] = 'іздеу';
		$search_ignore[] = 'оларға';
		$search_ignore[] = 'ал';
		$search_ignore[] = 'оларды';
		$search_ignore[] = 'жаққа';
		$search_ignore[] = 'әр';
		$search_ignore[] = 'қалай';
		$search_ignore[] = 'болған';
		$search_ignore[] = 'болатын';
		$search_ignore[] = 'кім';
		$search_ignore[] = 'біреу';
		$search_ignore[] = 'қайда';
		$search_ignore[] = 'ең';
		$search_ignore[] = 'кіші';
		$search_ignore[] = 'арасы';
		$search_ignore[] = 'дос';
		$search_ignore[] = 'менікі';
		$search_ignore[] = 'менің';
		$search_ignore[] = 'біз';

		return $search_ignore;
	}

	/**
	 * Returns the lower length limit of search words
	 *
	 * @return	integer  The lower length limit of search words.
	 * @since	1.6
	 */
	public static function getLowerLimitSearchWord()
	{
		return 3;
	}

	/**
	 * Returns the upper length limit of search words
	 *
	 * @return	integer  The upper length limit of search words.
	 * @since	1.6
	 */
	public static function getUpperLimitSearchWord()
	{
		return 20;
	}

	/**
	 * Returns the number of chars to display when searching
	 *
	 * @return	integer  The number of chars to display when searching.
	 * @since	1.6
	 */
	public static function getSearchDisplayedCharactersNumber()
	{
		return 200;
	}
}

