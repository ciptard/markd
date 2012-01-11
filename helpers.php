<?php

// TODO - Refactor into a class with static methods [mwalters :: 2012-01-10] 

function list_directory($dir, $count = null, $offset = 0) {
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

function sort_multidimensional($sortField, $toSorts, $order = 'ASC') {
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

function _debug($data) {
	echo '<div style="border: 1px solid #f00; padding: 5px; margin: 2px;">';
	if (is_array($data) OR is_object($data)) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	} elseif (is_string($data)) {
		echo $data;
	}
	echo '</div>';
}