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
				$file = THEMES_PATH . ACTIVE_THEME . '/footer.tpl';
				$templateContents = Filesystem::read_file($file);
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
			case '404':
				$file = THEMES_PATH . ACTIVE_THEME . '/404.tpl';
				$templateContents = Filesystem::read_file($file, $content);
				break;
			case 'page-content':
			default:
				break;
		}
		
		$templateContents = self::process_template($templateContents, $content, $templateName, $context);
		
		return $templateContents;
	}
	
	public static function process_template($template, $content = '', $templateName = '', $context = '') {
		$replacements = array(
			'{{site_title}}'   => SITE_TITLE,
			'{{site_url}}'     => SITE_URL,
			'{{site_desc}}'    => SITE_DESC,
			'{{current_year}}' => date('Y')
		);
		
		if (is_object($content)) {
			if ($content->id != '') { $replacements['{{post_id}}'] = $content->id; }
			if ($content->title != '') {
				$replacements['{{post_title}}'] = $content->title;
				$replacements['{{post_permalink}}'] = Helpers::sanitize_slug($content->title) . '.html';
			}
			if ($content->date != '') { $replacements['{{post_date}}'] = date(THEME_DATE_FORMAT, $content->date); }
			if ($content->html_content != '') { $replacements['{{post_content}}'] = $content->html_content; }
		}

		if ($templateName == 'footer') {
			global $currently_processing;
			if ($content === 0) {
				$replacements['{{page_previous}}'] = '<li></li>';
			} else if ($content === 1) {
				$replacements['{{page_previous}}'] = '<li class="prev"><a href="/">Previous</a></li>';
			} else {
				$replacements['{{page_previous}}'] = '<li class="prev"><a href="/archive-' . ($content - 1) . '.html">Previous</a></li>';
			}
			if ($currently_processing) {
				$replacements['{{page_next}}'] = '<li class="next"><a href="/archive-' . ($content + 1) . '.html">Next Page</a></li>';
			} else {
				$replacements['{{page_next}}'] = '<li></li>';
			}
			if ($context == 'single' || $context == '404') {
				$replacements['{{page_previous}}'] = '<li></li>';
				$replacements['{{page_next}}'] = '<li></li>';
			}
		}
		
		global $themeReplacements;
		if (is_array($themeReplacements)) {
			foreach ($themeReplacements as $themeReplacement=>$themeReplacementContent) {
				$replacements[$themeReplacement] = $themeReplacementContent;
			}
		}

		foreach ($replacements as $search=>$replace) {
			$template = str_replace($search, $replace, $template);
		}

		return $template;
	}
}
