<?php
/**
* Post Class
*/
class Post extends Content {
	public $content_type;

	function __construct($post_file) {		
		$this->content_type = 'post';
		parent::__construct($post_file);
	}
}