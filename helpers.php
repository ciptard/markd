<?php

/**
 * _debug() Function
 * 
 * This is specifically left out of the Helpers class because of developer preference for wanting to be able to just quickly type it.
 * 
 * @param mixed Any string, object, or array to be displayed to be printed out
 * @return null
 */
function _debug($data, $withHtml = FALSE) {
	if (!$withHtml) { echo "\n\n"; }
	if ($withHtml) { echo '<div style="border: 1px solid #f00; padding: 5px; margin: 2px;">'; }
	if (is_array($data) OR is_object($data)) {
		if ($withHtml) { echo '<pre>'; }
		print_r($data);
		if ($withHtml) { echo '</pre>'; }
	} elseif (is_string($data)) {
		if (!$withHtml) { echo "\n"; } else { echo "<br/>"; }
		echo $data;
		if (!$withHtml) { echo "\n"; } else { echo "<br/>"; }
	}
	if ($withHtml) { echo '</div>'; }
	if (!$withHtml) { echo "\n\n"; }
	return null;
}

/**
 * Helpers Class 
 * 
 * Uses functions (trailingslashit() and untrailingslashit()) from the WordPress Open Source Project -- http://wordpress.org/ (trailingslashit was slightly modified)
 * 
 */
class Helpers {	
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
	 */
	public static function feature_enabled($feature) {	
		if (defined($feature) && constant($feature) === true) { return true; }

		return false;
	}
	
	public static function sanitize_slug($toFilterString) {
		$filteredString = $toFilterString;
		$filteredString = str_replace(' ', '-', $filteredString);
		return $filteredString;
	}
	
	/**
	 * Appends a trailing slash.
	 *
	 * Will remove trailing slash if it exists already before adding a trailing
	 * slash. This prevents double slashing a string or path.
	 *
	 * The primary use of this is for paths and thus should be used for paths. It is
	 * not restricted to paths and offers no specific path support.
     *
	 * @uses Helpers::untrailingslashit() Unslashes string if it was slashed already.
	 *
	 * @param string $string What to add the trailing slash to.
	 * @return string String with trailing slash added.
	 */
	public static function trailingslashit($string) {
		return self::untrailingslashit($string) . '/';
	}

	/**
	 * Removes trailing slash if it exists.
	 *
	 * The primary use of this is for paths and thus should be used for paths. It is
	 * not restricted to paths and offers no specific path support.
	 *
	 * @since 2.2.0
	 *
	 * @param string $string What to remove the trailing slash from.
	 * @return string String without the trailing slash.
	 */
	public static function untrailingslashit($string) {
		return rtrim($string, '/');
	}
}