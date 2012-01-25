<?php
/**
* Post Class
*/
class Post extends Content {
	public $content_type;
	public $categories;

	function __construct($post_file) {		
		$this->content_type = 'post';
		$this->categories = array();
		parent::__construct($post_file);
	}
}