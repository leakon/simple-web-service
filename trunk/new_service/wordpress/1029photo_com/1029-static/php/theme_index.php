<?php

/*
## wp-content/themes/twentyten/index.php {total}
include(ABSPATH . '1029-static/php/theme_index.php');
*/

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>



<?php


#	$arrResult	= LeakonWP_Posts::getCategoryPosts(9, 'leakon_post_thumb-90x90');
#	CDebug::pr($arrResult);


$arrCateMap	= array();

if (file_exists('/home/work/web/baolaa.com')) {
	
	$arrCateMap['slide']		= 3;
	
	$arrCateMap['col_left']		= 4;
	$arrCateMap['col_middle']	= 5;
	$arrCateMap['col_right']	= 6;
	
	$arrCateMap['bot_left']		= 7;
	$arrCateMap['bot_right']	= 8;
	
} else {
	
	$arrCateMap['slide']		= 10;
	
	$arrCateMap['col_left']		= 11;
	$arrCateMap['col_middle']	= 12;
	$arrCateMap['col_right']	= 13;
	
	$arrCateMap['bot_left']		= 14;
	$arrCateMap['bot_right']	= 9;
	
}


?>

<?php
	$arrResult	= LeakonWP_Posts_Slide::getHomepageSlides($arrCateMap['slide']);
	
#	print_r($arrResult);
	
	include(ABSPATH . '1029-static/php/slide.php');
?>


<?php
	$arrResult	= array();
	$arrResult['left']	= LeakonWP_Posts_Slide::getHomepageColumn($arrCateMap['col_left']);
	$arrResult['middle']	= LeakonWP_Posts_Slide::getHomepageColumn($arrCateMap['col_middle']);
	$arrResult['right']	= LeakonWP_Posts_Slide::getHomepageColumn($arrCateMap['col_right']);
	
	$arrResult['bottom_left']	= LeakonWP_Posts::getCategoryPosts($arrCateMap['bot_left'], 'leakon_post_thumb-280x240');
	$arrResult['bottom_right']	= LeakonWP_Posts::getCategoryPosts($arrCateMap['bot_right'], 'leakon_post_thumb-40x40');
	
	include(ABSPATH . '1029-static/php/main_column.php');
?>



<?php 

#	get_sidebar();

?>


<?php get_footer(); ?>
