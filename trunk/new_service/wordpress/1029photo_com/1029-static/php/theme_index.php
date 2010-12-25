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

?>

<?php
	$arrResult	= LeakonWP_Posts_Slide::getHomepageSlides(10);
	include(ABSPATH . '1029-static/php/slide.php');
?>


<?php
	$arrResult	= array();
	$arrResult['left']	= LeakonWP_Posts_Slide::getHomepageColumn(11);
	$arrResult['middle']	= LeakonWP_Posts_Slide::getHomepageColumn(12);
	$arrResult['right']	= LeakonWP_Posts_Slide::getHomepageColumn(13);
	
	$arrResult['bottom_left']	= LeakonWP_Posts::getCategoryPosts(14, 'leakon_post_thumb-280x240');
	$arrResult['bottom_right']	= LeakonWP_Posts::getCategoryPosts(9, 'leakon_post_thumb-40x40');
	
	include(ABSPATH . '1029-static/php/main_column.php');
?>



<?php 

#	get_sidebar();

?>


<?php get_footer(); ?>
