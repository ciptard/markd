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
		$currently_processing = TRUE;

		$lastPublished = 0;																	// See Posts Class for a reasonable explanation of $lastPublished
		while ($currently_processing) {
			$blogPosts = array();
			$get_posts = $this->get_posts($lastPublished, POSTS_PER_PAGE);
			$lastPublished = $get_posts['lastPublished'];
			$blogPosts = $get_posts['blogPosts'];

			$this->write_post_list($this->currentPage, $blogPosts);
			if (count($blogPosts) < POSTS_PER_PAGE) { $currently_processing = FALSE; }		// Keep loop going until we reach a full page of posts
			
			if ($this->currentPage == 0) {
				// Create Feed Object and save
				$feed = new Feed();
				$feed->set_title(SITE_TITLE);
				$feed->set_selfLink(SITE_URL . '/feed.rss');
				$feed->set_siteLink(SITE_URL);
				if (SITE_DESC !== '') { $feed->set_description(SITE_DESC); }
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
				$feed->save();
			}
			
			$this->currentPage++;
		}
		
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
		} else {
			$file = PUBLISHED_PATH . '/archive-' . $pageNumber . '.html';
		}
		
		$writeContent = Helpers::locate_template('header');
		
		if (!empty($contentList)) {
			foreach($contentList as $content) {
				$writeContent .= $content->html_content;
				$this->write_single_post($content);
			}
		}

		$writeContent .= Helpers::locate_template('footer');

		$test = Helpers::write_file($file, $writeContent, 'w');
		if ($test) { $this->filesWritten++; }
	}
	
	public function write_single_post($content) {
		$file = Helpers::sanitize_slug($content->title);
		$file = PUBLISHED_PATH . '/' . $file . '.html';
		
		$writeContent = Helpers::locate_template('header');
		$writeContent .= $content->html_content;
		$writeContent .= Helpers::locate_template('footer');
		
		$test = Helpers::write_file($file, $writeContent, 'w');
		if ($test) { $this->filesWritten++; }
	}
	
	private function complete_process() {
		echo "\n\nProcessed " . $this->publishedPosts . " posts.";
		echo "\nWrote " . $this->filesWritten . " files.";
		echo "\n\n";
	}
}
