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
	
	public static function sanitize_slug($toFilterString) {
		$filteredString = $toFilterString;
		$filteredString = str_replace(' ', '-', $filteredString);
		return $filteredString;
	}
}