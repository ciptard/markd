<?php
/**
* Theme Class
*/
class Theme {
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
}
