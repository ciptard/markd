<?php
/**
* Theme Class
*/
class Theme {
	public static function locate_template($templateName, $context = '', $content = '') {
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
				if ($context === 'single') {
					$file = THEMES_PATH . ACTIVE_THEME . '/post-content-single.tpl';
					$templateContents = Filesystem::read_file($file, $content);
				} else {
					$file = THEMES_PATH . ACTIVE_THEME . '/post-content.tpl';
					$templateContents = Filesystem::read_file($file, $content);
				}
				break;
			case 'page-content':
			default:
				break;
		}
		
		$templateContents = self::process_template($templateContents, $content);
		
		return $templateContents;
	}
	
	public static function process_template($template, $content = '') {
		$replacements = array(
			'{{site_title}}' => SITE_TITLE,
			'{{site_url}}'   => SITE_URL,
			'{{site_desc}}'  => SITE_DESC
		);
		
		if (is_object($content)) {
			if ($content->id != '') { $replacements['{{post_id}}'] = $content->id; }
			if ($content->title != '') {
				$replacements['{{post_title}}'] = $content->title;
				$replacements['{{post_permalink}}'] = Helpers::sanitize_slug($content->title) . '.html';
			}
			if ($content->date != '') { $replacements['{{post_date}}'] = $content->date; }
			if ($content->html_content != '') { $replacements['{{post_content}}'] = $content->html_content; }
		}

		foreach ($replacements as $search=>$replace) {
			$template = str_replace($search, $replace, $template);
		}

		return $template;
	}
}
