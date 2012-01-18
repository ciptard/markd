<?php
/**
* Feed Class
*/
class Feed {
	private $itemList;
	private $title;
	private $selfLink;
	private $siteLink;
	private $description;
	
	
	public function add_item($item) {
		$this->itemList[] = $item;
	}
	
	public function delete_item($itemIndex) {
		unset($this->itemList[$itemIndex]);
	}
	
	public function update_item($itemIndex, $item) {
		$this->itemList[$itemIndex] = $item;
	}
	
	public function set_title($title) {
		$this->title = $title;
	}
	
	public function set_selfLink($selfLink) {
		$this->selfLink = $selfLink;
	}
	
	public function set_siteLink($siteLink) {
		$this->siteLink = $siteLink;
	}
	
	public function set_description($description) {
		$this->description = $description;
	}
	
	public function save() {
		$feedOutput = '<?xml version="1.0" encoding="UTF-8"?>
			<rss version="2.0"
				xmlns:content="http://purl.org/rss/1.0/modules/content/"
				xmlns:wfw="http://wellformedweb.org/CommentAPI/"
				xmlns:dc="http://purl.org/dc/elements/1.1/"
				xmlns:atom="http://www.w3.org/2005/Atom"
				xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
				xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
				xmlns:georss="http://www.georss.org/georss" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#" xmlns:media="http://search.yahoo.com/mrss/"
				>

				<channel>
					<title>' . $this->title . '</title>
					<atom:link href="' . $this->selfLink . '" rel="self" type="application/rss+xml" />
					<link>' . $this->siteLink . '</link>
					<description>' . $this->description . '</description>
					<lastBuildDate>' . date('D, j M Y H:i:s +0000') . '</lastBuildDate>
					<language>en</language>
					<sy:updatePeriod>hourly</sy:updatePeriod>
					<sy:updateFrequency>1</sy:updateFrequency>
					<generator>markd</generator>';
		if (!empty($this->itemList)) {
			foreach ($this->itemList as $item) {
				$feedOutput .= '
						<item>
							<title>' . $item->title . '</title>
							<link>' . $item->link . '</link>
							<pubDate>' . $item->pubDate . '</pubDate>
							<dc:creator>Matt</dc:creator>
							<guid isPermaLink="false">' . $item->link . '</guid>
							<description><![CDATA[' . $item->html_content . ']]></description>
							<content:encoded><![CDATA[' . $item->html_content . ']]></content:encoded>
						</item>
				';
			}
		}
		$feedOutput .= '
				</channel>
			</rss>';
		
		$file = PUBLISHED_PATH . '/rss.xml';
		$test = Helpers::write_file($file, $feedOutput, 'w');
	}
}
