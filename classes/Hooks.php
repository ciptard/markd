<?php
/**
* Hooks Class
*/
class Hooks {
	private $actionList;
	private $filterList;
	
	public function add_filter($filterName, $userFunction) {
		$this->filterList[$filterName][] = $userFunction;
	}
	
	public function execute_filters($filterName, $contentToFilter) {
		if (!isset($this->filterList[$filterName])) { return $contentToFilter; }

		foreach ($this->filterList[$filterName] as $executeFilter) {
			$contentToFilter = call_user_func($executeFilter, $contentToFilter);
			$contentToFilter .= '{{' . $filterName . '}}';
		}
		
		return $contentToFilter;
	}
}
