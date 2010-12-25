<?php



?>


	<script src="/1029-static/scripts/suckerfish.js" type="text/javascript"></script>
	<script src="/1029-static/scripts/jquery.min.js" type="text/javascript"></script>
	<script src="/1029-static/scripts/jquery.cycle.js" type="text/javascript"></script>
	<script src="/1029-static/scripts/jquery.functions.js" type="text/javascript"></script>
	<script src="/1029-static/scripts/jquery.tooltip.js" type="text/javascript"></script>
	<script src="/1029-static/scripts/jquery.dimensions.js" type="text/javascript"></script>
	
	<link rel="stylesheet" href="/1029-static/styles/style.css" type="text/css" media="screen" />

	<script type="text/javascript">
	$(function() {
		$('#slides a').tooltip({
			track: true,
			delay: 0,
			showURL: false,
			extraClass: "slides"
		});
	});
	</script>



	<div class="wrapper">
		<div id="featured">
			<div class="wrap contain">
				<div id="slides">
					<div id="slide-box">
						
						
						<div>                       
							
							<?php
							
							for ($i = 0; $i < 3; $i++) {
								
								echo	sprintf('<a href="%s" title="%s"><img src="%s" alt="%s" /></a>',
											$arrResult[$i]['post_guid'],
											$arrResult[$i]['post_title'],
											$arrResult[$i]['post_thumb'],
											$arrResult[$i]['post_title']
										);	
								
							}
							
							?>
							
						</div>
						
						<div>
							<?php
							
							for ($i = 3; $i < 6; $i++) {
								
								echo	sprintf('<a href="%s" title="%s"><img src="%s" alt="%s" /></a>',
											$arrResult[$i]['post_guid'],
											$arrResult[$i]['post_title'],
											$arrResult[$i]['post_thumb'],
											$arrResult[$i]['post_title']
										);		
								
							}
							
							?>                      
						</div>             	
					
					
					</div>
				</div> <!-- end slides -->
				
				<span id="slides-prev" class="slides_buttons"><a href="#" title="previous">上一页</a></span>
				<span id="slides-next" class="slides_buttons"><a href="#" title="next">下一页</a></span>
				
			</div> <!-- end wrap contain -->
		</div> <!-- end featured -->
	</div> <!-- end wrapper -->

