<?php
/**
* markd Class
* 
*/
class Markd {
	public $publishedPosts;
	private $currentPage;
	
	function __construct() {
		$this->publishedPosts = 0;
		$this->currentPage = 0;

		$this->process_blog_posts();
		$this->process_pages();
		$this->process_stylesheet();
		$this->process_javascript();
		
		$this->complete_process();
	}
	
	public function process_blog_posts() {
		// Process blog posts
		global $currently_processing;
		$currently_processing = TRUE;

		while ($currently_processing) {
			$blogPosts = array();
			$get_posts = $this->get_posts((POSTS_PER_PAGE * $this->currentPage), POSTS_PER_PAGE);

			$blogPosts = $get_posts['blogPosts'];

			if (count($blogPosts) < POSTS_PER_PAGE) { $currently_processing = FALSE; }		// Keep loop going until we reach a full page of posts
			$this->write_post_list($this->currentPage, $blogPosts);
			
			if ($this->currentPage == 0) {
				$this->process_feed($blogPosts);
			}
			
			$this->currentPage++;
		}
	}
	
	public function process_pages() {
		// Process pages
		$get_pages = $this->get_pages();
		$pages = $get_pages['pages'];

		foreach ($pages as $pageFile) {
			$page = new Page($pageFile);
			$this->write_page($page);
		}
	}
	
	public function process_stylesheet() {
		$styleSheet = Filesystem::read_file(THEMES_PATH . '/' . ACTIVE_THEME . '/style.css');
		Filesystem::write_file(PUBLISHED_PATH . '/style.css', $styleSheet);
	}
	
	public function process_javascript() {
		$commonJavaScript = Filesystem::read_file(THEMES_PATH . '/' . ACTIVE_THEME . '/common.js');
		Filesystem::write_file(PUBLISHED_PATH . '/common.js', $commonJavaScript);		
	}
	
	public function process_feed($blogPosts) {
		// Create Feed Object and save
		$feed = new Feed();
		$feed->set_title(SITE_TITLE);
		$feed->set_selfLink(SITE_URL . '/feed.rss');
		$feed->set_siteLink(SITE_URL);
		if (SITE_DESC !== '') { $feed->set_description(SITE_DESC); }
		if (!empty($blogPosts)) {
			foreach ($blogPosts as $blogPost) {
				unset($item);
				$item = (object) array(
					'id'           => $blogPost->id,
					'title'        => $blogPost->title,
					'link'         => SITE_URL . '/' . Helpers::sanitize_slug($blogPost->title) . '.html',
					'pubDate'      => date('D, j M Y H:i:s +0000', $blogPost->date),
					'html_content' => $blogPost->html_content
				);
				$feed->add_item($item);
			}
		}
		$feed->save();
	}
	
	public function get_posts($startPostNum, $numberOfPosts) {
		$posts = Posts::get_posts($startPostNum, $numberOfPosts);
		$this->publishedPosts = $this->publishedPosts + count($posts['blogPosts']);

		return $posts;
	}
	
	public function get_pages() {
		$pages = Filesystem::list_directory(PAGES_PATH);

		foreach ($pages as $pageFile) {
			$page = new Page($pageFile);
			if ($page->published == true) {
				$returnPageListing['pages'][] = $pageFile;
			}
		}

		return $returnPageListing;
	}
	
	public function write_post_list($pageNumber, $contentList) {
		if (count($contentList) < 1) { return FALSE; }
		
		if ($pageNumber == 0) {
			$file = PUBLISHED_PATH . '/index.html';
			$context = 'posting-index';
		} else {
			$file = PUBLISHED_PATH . '/archive-' . $pageNumber . '.html';
			$context = 'posting-archive';
		}
		
		$writeContent = Theme::locate_template('header');
		
		if (!empty($contentList)) {
			foreach($contentList as $content) {
				$writeContent .= Theme::locate_template('post-content', $context, $content);
				$this->write_single_post($content);
			}
		}

		$writeContent .= Theme::locate_template('footer', '', $pageNumber);

		Filesystem::write_file($file, $writeContent, 'w');
	}
	
	public function write_single_post($content) {
		$file = Helpers::sanitize_slug($content->title);
		$file = PUBLISHED_PATH . '/' . $file . '.html';
		
		$writeContent = Theme::locate_template('header');
		$writeContent .= Theme::locate_template('post-content', 'single', $content);
		$writeContent .= Theme::locate_template('footer', 'single');

		Filesystem::write_file($file, $writeContent, 'w');
	}
	
	public function write_page($page) {
		$file = Helpers::sanitize_slug($page->title);
		$file = PUBLISHED_PATH . '/' . $file . '.html';

		if (strpos($page->content_file, '404.md') !== false) {
			$file = PUBLISHED_PATH . '/404.html';
		}
		
		$writeContent = Theme::locate_template('header');
		$writeContent .= Theme::locate_template('page', '', $page);
		$writeContent .= Theme::locate_template('footer', 'single');

		Filesystem::write_file($file, $writeContent, 'w');
	}
	
	private function complete_process() {
		global $filesWritten;
		
		echo "\n\nProcessed " . $this->publishedPosts . " posts.";
		echo "\nWrote " . $filesWritten . " files.";
		echo "\n\n";
	}
}
