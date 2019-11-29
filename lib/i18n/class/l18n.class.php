<?php
/**
* l10n
* @author Romain LAURENT - http://www.romainlaurent.com
* @version	0.2
* 
* Todolist:
* - internationnalisation du t�l�phone
**/
 
include_once('JSON.php');
 
$GLOBALS['LANGUAGE'] 	= '';
$GLOBALS['DICTIONARY'] 	= Array();
 
class I18n {
 
	/**
	 * @param String Lang ISO 639-1
	 * @param String Path for the lang file. Default: "."
	 * @return Boolean File parsing OK
	 */
        private static $instance;

	static function get_instance() {
		if(!is_object(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}
        
	static function setLang ($lang, $path = '.') {
		$GLOBALS['LANGUAGE'] = $lang;
 
		$path = (substr($path, (strlen($path) - 1)) == '../')?$path:$path.'/';
		if (empty($GLOBALS['DICTIONARY'][$GLOBALS['LANGUAGE']])) {
			$json = new Services_JSON();
			if (file_exists($path.'lang_'.$lang.'.ini')) {
				$input = file_get_contents($path.'lang_'.$lang.'.ini');
	 			$GLOBALS['DICTIONARY'][$GLOBALS['LANGUAGE']] = $json->decode($input);
	 			return(true);
			}
			else {
				return(false);
			}
		}
		else {
			return(true);
		}
	}
 
	/**
	 * @param String Id for text
	 * @return String
	 */
	function getText ($id) {
		if (isset($GLOBALS['DICTIONARY'][$GLOBALS['LANGUAGE']]->$id)) {
			return($GLOBALS['DICTIONARY'][$GLOBALS['LANGUAGE']]->$id);
		}
		else {
			return($id.'::pas de traduction');
		}
	}
 
	/**
	 * @return String
	 */
	function getLang () {
		$l = (empty($GLOBALS['LANGUAGE']))?'LANG UNDEFINED':$GLOBALS['LANGUAGE'];
 
		return($l);
	}
}

?>
