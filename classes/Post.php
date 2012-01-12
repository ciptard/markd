<?php
/**
* Post Class
*/
class Post {
	public $post_file;
	public $raw_contents;
	public $title;
	public $date;
	public $published;
	public $raw_content;
	public $html_content;

	function __construct($post_file) {		
		$this->post_file = $post_file;
		$this->load_post();
		$this->parse_post();
	}

	function load_post() {
		$handle = fopen($this->post_file, "r");
		$this->raw_contents = fread($handle, filesize($this->post_file));
		fclose($handle);
	}

	function parse_post() {
		$content_start = strpos($this->raw_contents, '---', 4);
		$raw_headings = trim(substr($this->raw_contents, 3, ($content_start - 3)));
		$raw_headings = explode("\n", $raw_headings);

		foreach ($raw_headings as $raw_heading) {
			if ($raw_heading != '') {
				$temp = explode(':', $raw_heading);
				if ($temp[0] == 'Date') { $temp[1] = strtotime($temp[1]); }
				$heading[$temp[0]] = $temp[1];
			}
		}

		$this->title         = trim($heading['Title']);
		$this->date          = trim($heading['Date']);
		$this->published     = trim($heading['Published']);
		$this->raw_content   = trim(substr($this->raw_contents, ($content_start + 4), strlen($this->raw_contents)));
		if (Helpers::feature_enabled('MARKD_DEBUG')) { $this->raw_contents  .= "\n\n" . $this->post_file; }
		$this->html_content  = trim(Markdown(substr($this->raw_contents, ($content_start + 4), strlen($this->raw_contents))));
	}
}