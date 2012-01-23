<?php
/**
* Filesystem Class
*/
class Filesystem {
	public static function list_directory($dir) {
		$file_list = '';
		$stack[] = $dir;
		while ($stack) {
			$current_dir = array_pop($stack);
			if ($dh = opendir($current_dir)) {
				while (($file = readdir($dh)) !== false) {
					if ($file !== '.' AND $file !== '..' AND $file != '.DS_Store') {
						$current_file = "{$current_dir}/{$file}";
						if (is_file($current_file)) {
							$file_list[] = "{$current_dir}/{$file}";
						} elseif (is_dir($current_file)) {
							$stack[] = $current_file;
						}
					}
				}
			}
		}
		return $file_list;
	}
	
	public static function directory_to_array($dir) {
		// This function is taken from: http://stackoverflow.com/a/952403
		$contents = array();
		// Foreach node in $dir
		foreach (scandir($dir) as $node) {
			// Skip link to current and parent folder
			if ($node == '.')  continue;
			if ($node == '..') continue;
			if ($node == '.DS_Store') continue;
	
			// Check if it's a node or a folder
			if (is_dir($dir . DIRECTORY_SEPARATOR . $node)) {
				// Add directory recursively, be sure to pass a valid path
				// to the function, not just the folder's name
				$contents[$node] = self::directory_to_array($dir . DIRECTORY_SEPARATOR . $node);
			} else {
			 	// Add node, the keys will be updated automatically
				$contents[] = $node;
			}
		}
		# done
		return $contents;
	}
	
	public static function write_file($file = '', $content = '', $mode = 'w') {
		if ($file == '') { return FALSE; }

		global $filesWritten;
		$filesWritten++;

		$fp = fopen($file, $mode);
		fwrite($fp, $content);
		fclose($fp);
		
		return TRUE;
	}

	public static function read_file($file = '') {
		if ($file == '') { return FALSE; }

		$handle = fopen($file, "r");
		$contents = fread($handle, filesize($file));
		fclose($handle);
		
		return $contents;
	}
}
