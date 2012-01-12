<?php
/**
* Posts Class
*/
class Posts {
	private $post_listing;				// Array of Post files
	private $posts;						// Post objects
	private $published_posts;			// Count of published posts
	private $unpublished_posts;			// Count of unpublished posts
	private $current_page;				// Pagination tracking
	
	function __construct() {
		$this->published_posts = 0;
		$this->unpublished_posts = 0;
		$this->current_page = 0;
		$this->process_posts();
	}
	
	private function process_posts() {
		$currently_processing = true;
		while ($currently_processing) {			// Loop through posts to write out front page and archive pages
			$this->post_listing = array();
			$this->post_listing = Helpers::list_directory(POSTS_PATH, POSTS_PER_PAGE, ($this->current_page * POSTS_PER_PAGE));
			$this->parse_posts();
			if ($this->current_page == 0) {
				$this->write_front_page();
			} else {
				$this->write_archive_page();
			}
			if (count($this->post_listing) < POSTS_PER_PAGE) {
				$currently_processing = false;
			} else {
				$this->current_page++;
			}
		}
		$this->complete_process();
	}
	
	public function parse_posts() {				// Create Post objects
		$this->posts = array();
		if (!empty($this->post_listing)) {
			foreach ($this->post_listing as $k=>$post_file) {
				unset($post);
				$post = new Post($post_file);
				if ($post->published == 'false') {
					$this->unpublished_posts++;
				} else {
					$this->published_posts++;
				}
				$this->posts[] = $post;
			}
		}
		$this->posts = Helpers::sort_multidimensional('date', $this->posts, POSTS_SORT_ORDER);
	}
	
	public function write_front_page() {		// Write out Front Page
		$fp = fopen(PUBLISHED_PATH . '/index.html', 'w');
		if (!empty($this->posts)) {
			foreach($this->posts as $post) {
				$fp = fopen(PUBLISHED_PATH . '/index.html', 'a');
				fwrite($fp, $post->html_content);
				fclose($fp);
			}
		}
	}
	
	public function write_archive_page() {		// Write out archive page
		$fp = fopen(PUBLISHED_PATH . '/archive-' . $this->current_page . '.html', 'w');
		if (!empty($this->posts)) {
			foreach($this->posts as $post) {
				$fp = fopen(PUBLISHED_PATH . '/archive-' . $this->current_page . '.html', 'a');
				fwrite($fp, $post->html_content);
				fclose($fp);
			}
		}
	}
	
	private function complete_process() {		// Display statistics
		echo "\n\nProcessed " . ($this->published_posts + $this->unpublished_posts) . " posts (Published: $this->published_posts / Unpublished: $this->unpublished_posts).";
		echo "\n\n";
	}
}
