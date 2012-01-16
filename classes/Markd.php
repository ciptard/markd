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

			$this->write_file($this->currentPage, $blogPosts);
			if (count($blogPosts) < POSTS_PER_PAGE) { $currently_processing = FALSE; }		// Keep loop going until we reach a full page of posts
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
	
	public function write_file($pageNumber, $contentList) {
		if (count($contentList) < 1) { return FALSE; }
		
		if ($pageNumber == 0) {
			$file = PUBLISHED_PATH . '/index.html';
		} else {
			$file = PUBLISHED_PATH . '/archive-' . $pageNumber . '.html';
		}
		
		$fp = fopen($file, 'w');

		$header = Helpers::locate_template('header');
		fwrite($fp, $header);
		
		if (!empty($contentList)) {
			foreach($contentList as $content) {
				fwrite($fp, $content->html_content);
			}
		}

		$footer = Helpers::locate_template('footer');
		fwrite($fp, $footer);
		fclose($fp);
		
		$this->filesWritten++;
	}
	
	private function complete_process() {
		echo "\n\nProcessed " . $this->publishedPosts . " posts.";
		echo "\nWrote " . $this->filesWritten . " files.";
		echo "\n\n";
	}
}
