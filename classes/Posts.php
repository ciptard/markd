<?php
/**
* Posts Class
*/
class Posts {
	public static function get_posts($startPostNum, $numberOfPosts) {
		if ($startPostNum === '' || $numberOfPosts == '' || $numberOfPosts < 1) { return FALSE; }

		$returnPostListing = array();

		/*
		Last published is a bit interesting.  Essentially the deal is that unpublished posts can exist in the posts directory.  In order to
		conserve on memory usage, we only grab and process POSTS_PER_PAGE number of posts at a time.  This makes it possible that a page of
		posts could end up with less than POSTS_PER_PAGE on a page, so $lastPublished is used to track an index position of where we are in
		the total file list so that when this loop is entered into again, we can start off at the proper place.
		*/

		$lastPublished = $startPostNum;

		do {
			$postListing = Filesystem::list_directory(POSTS_PATH, $numberOfPosts, $lastPublished);

			if (!empty($postListing)) {
				foreach ($postListing as $postFile) {
					$post = new Post($postFile);
					if ($post->published == 'true' && count($returnPostListing['blogPosts']) < $numberOfPosts) {
						$returnPostListing['blogPosts'][] = $post;
					}
					if (count($returnPostListing['blogPosts']) < $numberOfPosts) { $lastPublished++; }
				}
			}
			
			$startPostNum = $startPostNum + $numberOfPosts;
		} while (count($returnPostListing['blogPosts']) < $numberOfPosts && count($postListing) == $numberOfPosts);
		
		$returnPostListing['lastPublished'] = $lastPublished + 1;
		return $returnPostListing;
	}
}
