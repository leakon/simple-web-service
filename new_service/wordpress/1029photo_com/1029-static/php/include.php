<?php

/*
## wp-config.php {bottom}
include(ABSPATH . '1029-static/php/theme_index.php');
*/


class LeakonWP_Posts {
	
	public static function getCategoryPosts($intCateID, $size = 'post-thumbnail') {
		
		$wp	= new WP();
		
		$wp->set_query_var('cat', $intCateID);
		$wp->query_posts();
		$wp->register_globals();
		
		$arrThumbnails	= array();
		
		foreach ($GLOBALS['posts'] as $post) {
			
		#	CDebug::pr($post);	
			
			$postID		= $post->ID;
			
			$src		= self::getPostThumbnail($postID, $size);
			
			$arrThumbnails[$postID]	= $src;
			
		}
		
		
		$arrRet	= array(
				'posts'		=> $GLOBALS['posts'],
				'thumbs'	=> $arrThumbnails,
			#	'post'	=> $GLOBALS['post'],
			);
			
			
		
		
		
		return	$arrRet;
		
	}	
	
	protected static function getPostThumbnail($postID, $size = 'post-thumbnail') {
		
		$html	= get_the_post_thumbnail($postID, $size);
		
	#	print_r($html);
		
		preg_match('#src="([^"]+)"#i', $html, $match);
		
		$src	= isset($match[1]) ? $match[1] : '';
		
		return	$src;
		
		CDebug::pr(($src), $postID);
		
	}
	
	public static function getHomepageColumn($intCategoryID) {
		
		$arrPosts	= self::getCategoryPosts($intCategoryID);
		
		return	$arrPosts['posts'][0];
		
	}
}


class LeakonWP_Posts_Thumb extends LeakonWP_Posts {
	
	public static function initThumbConf() {
		
		add_image_size( 'leakon_post_thumb-320x320', 320, 320 );
		add_image_size( 'leakon_post_thumb-280x240', 280, 240 );
		add_image_size( 'leakon_post_thumb-120x120', 120, 120 );
		add_image_size( 'leakon_post_thumb-90x90', 90, 90 );
		add_image_size( 'leakon_post_thumb-50x50', 50, 50 );
	
	}
	
}



class LeakonWP_Posts_Slide extends LeakonWP_Posts {
	
	public static function getHomepageSlides($intSlideCategoryID) {
		
		$arrRet		= array();
		
		
		$arrPosts	= self::getCategoryPosts($intSlideCategoryID, 'leakon_post_thumb-280x240');
		
		if (count($arrPosts['posts']) > 5) {
			
			for ($i = 0; $i < 6; $i++) {
				
				$post		= $arrPosts['posts'][$i];
				
				$postID		= $post->ID;
				
				$arrRet[]	= array(
						
							'ID'		=> $postID,
							'post_title'	=> $post->post_title,
							'post_title'	=> $post->post_content,
							'post_guid'	=> $post->guid,
							'post_thumb'	=> $arrPosts['thumbs'][$postID],
						
						);
				
			}
			
		}
		
	#	CDebug::pr($arrRet);
	#	CDebug::pr($arrPosts);
		
		return	$arrRet;
		
	}
	
}



LeakonWP_Posts_Thumb::initThumbConf();
