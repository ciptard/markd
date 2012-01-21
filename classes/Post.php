<?php
/**
* Post Class
*/
class Post {
	public $post_file;
	public $raw_contents;
	public $id;
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
		$this->raw_contents = Filesystem::read_file($this->post_file);
	}

	function parse_post() {
		$content_start = strpos($this->raw_contents, '---', 4);
		$raw_headings = trim(substr($this->raw_contents, 3, ($content_start - 3)));
		$raw_headings = explode("\n", $raw_headings);

		foreach ($raw_headings as $raw_heading) {
			if ($raw_heading != '') {
				$temp = explode(':', $raw_heading);
				if ($temp[0] == 'Date') {
					$temp[1] = trim($temp[1]);
					$dateTime = explode(' ', $temp[1] . ':' . $temp[2]);
					$date = explode('-', $dateTime[0]);
					$time = explode(':', $dateTime[1]);
					$temp[1] = mktime($time[0], $time[1], 0, $date[1], $date[2], $date[0]);
				}
				$heading[$temp[0]] = $temp[1];
			}
		}

		$this->id            = md5($heading['Date']);
		$this->title         = trim($heading['Title']);
		$this->date          = trim($heading['Date']);
		$this->published     = trim($heading['Published']);
		$this->raw_content   = trim(substr($this->raw_contents, ($content_start + 4), strlen($this->raw_contents)));
		if (Helpers::feature_enabled('MARKD_DEBUG')) { $this->raw_contents  .= "\n\n" . $this->post_file; }
		$this->html_content  = trim(Markdown(substr($this->raw_contents, ($content_start + 4), strlen($this->raw_contents))));
	}
}