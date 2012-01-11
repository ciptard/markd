<?php
/**
* Posts Class
*/
class Posts {
	private $post_listing;
	private $posts;
	private $published_posts;
	private $unpublished_posts;
	
	function __construct() {
		$this->published_posts = 0;
		$this->unpublished_posts = 0;
		$this->process_posts();
	}
	
	private function process_posts() {
		$this->post_listing = Helpers::list_directory(POSTS_PATH, POSTS_PER_PAGE, 0);
		$this->parse_posts();
		$this->write_front_page();
		$this->complete_process();
	}
	
	public function parse_posts() {
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
	
	public function write_front_page() {
		$fp = fopen(PUBLISHED_PATH . '/index.html', 'w');
		if (!empty($this->posts)) {
			foreach($this->posts as $post) {
				$fp = fopen(PUBLISHED_PATH . '/index.html', 'a');
				fwrite($fp, $post->html_content);
				fclose($fp);
			}
		}
	}
	
	public function write_archive_page($page_number = null) {
		
	}
	
	private function complete_process() {
		echo "\n\nProcessed " . ($this->published_posts + $this->unpublished_posts) . " posts (Published: $this->published_posts / Unpublished: $this->unpublished_posts).";
		echo "\n\n";
	}
}
