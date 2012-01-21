<?php
/**
* markd Class
* 
*/
class Markd {
	public $publishedPosts;
	public $filesWritten;
	private $currentPage;
	
	function __construct() {
		$this->publishedPosts = 0;
		$this->filesWritten = 0;
		$this->currentPage = 0;

		// Process blog posts
		global $currently_processing;
		$currently_processing = TRUE;

		$lastPublished = 0;																	// See Posts Class for a reasonable explanation of $lastPublished
		while ($currently_processing) {
			$blogPosts = array();
			$get_posts = $this->get_posts($lastPublished, POSTS_PER_PAGE);

			$lastPublished = $get_posts['lastPublished'];
			$blogPosts = $get_posts['blogPosts'];

			if (count($blogPosts) < POSTS_PER_PAGE) { $currently_processing = FALSE; }		// Keep loop going until we reach a full page of posts
			$this->write_post_list($this->currentPage, $blogPosts);
			
			if ($this->currentPage == 0) {
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
			
			$this->currentPage++;
		}
		
		$styleSheet = Filesystem::read_file(THEMES_PATH . '/' . ACTIVE_THEME . '/style.css');
		Filesystem::write_file(PUBLISHED_PATH . '/style.css', $styleSheet);
		
		$this->complete_process();
	}
	
	public function get_posts($startPostNum, $numberOfPosts) {
		$posts = Posts::get_posts($startPostNum, $numberOfPosts);
		$this->publishedPosts = $this->publishedPosts + count($posts['blogPosts']);

		return $posts;
	}
	
	public function get_pages() { } // Stub
	
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

		$test = Filesystem::write_file($file, $writeContent, 'w');
		if ($test) { $this->filesWritten++; }
	}
	
	public function write_single_post($content) {
		$file = Helpers::sanitize_slug($content->title);
		$file = PUBLISHED_PATH . '/' . $file . '.html';
		
		$writeContent = Theme::locate_template('header');
		$writeContent .= Theme::locate_template('post-content', 'single', $content);
		$writeContent .= Theme::locate_template('footer', 'single');

		$test = Filesystem::write_file($file, $writeContent, 'w');
		if ($test) { $this->filesWritten++; }
	}
	
	private function complete_process() {
		echo "\n\nProcessed " . $this->publishedPosts . " posts.";
		echo "\nWrote " . $this->filesWritten . " files.";
		echo "\n\n";
	}
}
