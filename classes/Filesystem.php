<?php
/**
* Filesystem Class
*/
class Filesystem {
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
	
	public static function write_file($file = '', $content = '', $mode = 'w') {
		if ($file == '') { return FALSE; }

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