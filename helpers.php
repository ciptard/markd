<?php

/**
 * _debug() Function
 * 
 * This is specifically left out of the Helpers class because of developer preference for wanting to be able to just quickly type it.
 * 
 * @param mixed Any string, object, or array to be displayed to be printed out
 * @return null
 **/
function _debug($data, $withHtml = FALSE) {
	if (!withHtml) { echo "\n\n"; }
	if ($withHtml) { echo '<div style="border: 1px solid #f00; padding: 5px; margin: 2px;">'; }
	if (is_array($data) OR is_object($data)) {
		if ($withHtml) { echo '<pre>'; }
		print_r($data);
		if ($withHtml) { echo '</pre>'; }
	} elseif (is_string($data)) {
		echo $data;
	}
	if ($withHtml) { echo '</div>'; }
	if (!withHtml) { echo "\n\n"; }
	return null;
}

/**
* Helpers Class
*/
class Helpers {
	public static function list_directory($dir, $count = null, $offset = 0) {
		$file_list = '';
		$stack[] = $dir;
		$ctr = 0;
		while ($stack) {
			$current_dir = array_pop($stack);
			if ($dh = opendir($current_dir)) {
				while (($file = readdir($dh)) !== false) {
					if ($file !== '.' AND $file !== '..' AND $file != '.DS_Store') {
						$current_file = "{$current_dir}/{$file}";
						if (is_file($current_file)) {
							$ctr++;
							if ($ctr > $offset) {
								$file_list[] = "{$current_dir}/{$file}";
							}
							if ($ctr == ($offset + $count)) {
								return $file_list;
							}
						} elseif (is_dir($current_file)) {
							$stack[] = $current_file;
						}
					}
				}
			}
		}
		return $file_list;
	}
	
	public static function sort_multidimensional($sortField, $toSorts, $order = 'ASC') {
		if ($order == 'DESC') { $order = SORT_DESC; } else { $order = SORT_ASC; }

		$keyIndex = array();
		foreach ($toSorts as $toSort) {
			if (is_object($toSort)) {
				$keyIndex[] = $toSort->$sortField;
			} else {
				$keyIndex[] = $toSort[$sortField];
			}
		}
		array_multisort($keyIndex, $order, $toSorts);

		return $toSorts;
	}
	
	/**
	 * Figure out if a feature is enabled in the configuration file
	 * The constant needs to both be defined and set to true in order to be enabled
	 * 
	 * @param   string the feature to be checked
	 * @return	bool True if the feature is both defined and set to true, False if it is not defined or not set to true
	 **/
	public static function feature_enabled($feature) {	
		if (defined($feature) && constant($feature) === true) { return true; }

		return false;
	}
	
	public static function locate_template($templateName) {
		switch($templateName) {
			case 'header':
				$file = THEMES_PATH . ACTIVE_THEME . '/header.tpl';
				$handle = fopen($file, "r");
				$templateContents = fread($handle, filesize($file));
				fclose($handle);
				break;
			case 'footer':
				$file = THEMES_PATH . ACTIVE_THEME . '/footer.tpl';
				$handle = fopen($file, "r");
				$templateContents = fread($handle, filesize($file));
				fclose($handle);
				break;
			default:
				break;
		}
		
		return $templateContents;
	}
	
	public static function sanitize_slug($toFilterString) {
		$filteredString = $toFilterString;
		$filteredString = str_replace(' ', '-', $filteredString);
		return $filteredString;
	}
}