<?php
/**
* Page Class
*/
class Page extends Content {
	public $content_type;

	function __construct($post_file) {		
		$this->content_type = 'page';
		parent::__construct($post_file);
	}
}