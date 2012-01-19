<?php
/**
* Theme Class
*/
class Theme {
	public static function locate_template($templateName, $context = '') {
		switch($templateName) {
			case 'header':
				if ($context === '') {
					$file = THEMES_PATH . ACTIVE_THEME . '/header.tpl';
					$templateContents = Filesystem::read_file($file);
				}
				break;
			case 'footer':
				if ($context === '') {
					$file = THEMES_PATH . ACTIVE_THEME . '/footer.tpl';
					$templateContents = Filesystem::read_file($file);
				}
				break;
			case 'post-content':
				
				break;
			case 'page-content':
			default:
				break;
		}
		
		return $templateContents;
	}
	
	public static function process_template($content) {
		
	}
}
