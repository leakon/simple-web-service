<?php

#	CDebug::pr($arrResult);


function getColumnHtml($post) {

	$html	= '
					<h3>'
					. sprintf('<a href="%s" title="">%s</a>', $post->post_guid, $post->post_title
									)
					. '
					</h3>
					<div class="content">'
					. sprintf('%s', $post->post_content)
					. '	
					</div>
					';
	
	return	$html;
	
	
}

?>



<style>

</style>

		<div id="container">
			<div id="content" role="main">

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			# get_template_part( 'loop', 'index' );
			
			?>
			
			
			<div id="front_article">
				
				<div class="article_left column">
					<?php
						echo	getColumnHtml($arrResult['left']);
					?>
				</div>
				
				<div class="article_middle column">
					<?php
						echo	getColumnHtml($arrResult['middle']);
					?>
				</div>
				
				<div class="article_right column">
					<?php
						echo	getColumnHtml($arrResult['right']);
					?>
				</div>
				
			</div>
			
			
			
			<div id="front_block">
			
				<div class="block_left blocks">
		

<?php


#	CDebug::pr($arrResult['bottom_left']);
#	CDebug::pr($arrResult['bottom_right']);
	
	$post		= $arrResult['bottom_left']['posts'][0];
	$postID		= $post->ID;
	
	$thumb		= $arrResult['bottom_left']['thumbs'][$postID];

?>
	
	
			
					<div id="fb_picture">
						<img src="<?php echo $thumb ?>" width="180" />
					</div>
				
					<div id="fb_content">
						<h3><?php echo $post->post_title ?></h3>
						<p>
							<?php echo $post->post_content ?>	
						</p>
					</div>
				
				
				</div>
				
				
				<div class="block_right blocks">
				
					<ul id="fb_right_list">
						
						<?php 
							for ($i = 0; $i < 6; $i++) :
							
							
								$post		= $arrResult['bottom_right']['posts'][$i];
								$postID		= $post->ID;
								
								$thumb		= $arrResult['bottom_right']['thumbs'][$postID];
							
							
						?>
						
						<li>
							
							<div class="fbrl_pic">
								<img src="<?php echo $thumb ?>" width="50" height="50" class="bottom_right" />
							</div>
							
							<div class="fbrl_content">
								<h4><?php echo $post->post_title ?></h4>
								
								<p>
									<?php echo $post->post_content ?>
								</p>
							</div>
							
						</li>
						
						<?php
							endfor;
						?>
						
					</ul>
				
				</div>
				
			</div>
				
			
			
			
			</div><!-- #content -->
		</div><!-- #container -->






