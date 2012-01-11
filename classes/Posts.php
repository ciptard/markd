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
				$handle = fopen($post_file, "r");
				$contents = fread($handle, filesize($post_file));
				fclose($handle);
				$content_start = strpos($contents, '---', 4);
				$raw_headings = trim(substr($contents, 3, ($content_start - 3)));
				$raw_headings = explode("\n", $raw_headings);

				foreach ($raw_headings as $raw_heading) {
					if ($raw_heading != '') {
						$temp = explode(':', $raw_heading);
						if ($temp[0] == 'Date') { $temp[1] = strtotime($temp[1]); }
						$heading[$temp[0]] = $temp[1];
					}
				}
				// TODO - Move this into the Post class, was silly of me to put it here [mwalters :: 2012-01-10] 
				$this->posts[] = (object) array(
					'title'        => $heading['Title'],
					'date'         => $heading['Date'],
					'published'    => $heading['Published'],
					'filename'     => $post_file,
					'raw_content'  => substr($contents, ($content_start + 4), strlen($contents)),
					'html_content' => Markdown(substr($contents, ($content_start + 4), strlen($contents)))
				);
				if ($heading['Published'] == 'true') {
					$this->published_posts++;
				} else {
					$this->unpublished_posts++;
				}
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
